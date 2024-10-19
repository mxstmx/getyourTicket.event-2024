<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function Clue\StreamFilter\register;

use App\Http\Controllers\SmsNotificationController;
use Classiebit\Eventmie\Notifications\MailNotification;

class GuestController extends Controller
{
    /**
     *  organizer create user
     */

    public function registerGuest(Request $request)
    {
        //login
        if(empty((int)$request->is_login))
            return $this->register($request);

        // register
        return $this->login($request);
                   
    } 

    
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'max:512']
        ]);

        // check if email exists
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            $request->validate([
                'password1'            => 'required',
            ],[
                'password1.required' => __('eventmie-pro::em.email_not_exists'),
            ]);
        }

        $flag = \Auth::attempt ([
            'email'    => $request->email,
            'password' => $request->password 
        ]);
        
        if(!$flag)
        {
            $request->validate([
                'password1'            => 'required',
            ],[
                'password1.required' => __('eventmie-pro::em.password_not_match'),
            ]);
        }

        $stripe_secret_key     = null;

        $user = \Auth::user();

        if(!empty(setting('apps.stripe_public_key')) && !empty(setting('apps.stripe_secret_key')))
            $stripe_secret_key = $user->createSetupIntent()->client_secret;


        if(checkPrefix())
            return response()->json(['status' => true, 'guest' => $user, 'token' => $user->createToken($request->device_name)->plainTextToken]);

        if(!empty((int)$request->is_otp_checkout))
            session(['delete_guest_user' => 1]);

        return response()->json([
            'status' => true, 
            'user' => $user->only(['id', 'name', 'phone', 'email' , 'avatar']),
            'verify_email' => 1, 
            'is_verify_email' => setting('multi-vendor.verify_email'), 
            'stripe_secret_key' => $stripe_secret_key,
            'is_customer' => (\Auth::user()->hasRole(['organiser', 'admin']) ? 0 : 1)
        ]);     
    
    }
        
    /**
     * register
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'         => [ !empty($request->guest_checkout) ? 'nullable' : 'required', 'max:512'],
            'phone'            => 'required|numeric',
        ],[
            'email.unique' => __('eventmie-pro::em.email_already_exists'),
        ]);

        $guest_password = Str::random(10);
        // create user
        $user = User::create([
                    'name'          => $request->name,
                    'email'         => !empty($request->email) ? $request->email : setting('apps.customer_default_email'),
                    'password'      => !empty($request->guest_checkout) ? \Hash::make($guest_password) : \Hash::make($request->password),
                    'role_id'       =>  2,
                    'phone'         => preg_replace('/\s+/', '', $request->phone),
                ]);

        $user->roles()->sync([2]);

        $user->role_id = 2;

        $user->save();
        
        
        if(checkPrefix())
            return response()->json(['status' => true, 'guest' => $user, 'token' => $user->createToken($request->device_name)->plainTextToken]);

        // auto login
        \Auth::login($user);

        if(!empty((int)$request->is_otp_checkout))
            session(['delete_guest_user' => 1]);

        // ====================== Notification ====================== 
        $mail['mail_subject']   = __('eventmie-pro::em.register_success');
        $mail['mail_message']   = __('eventmie-pro::em.get_tickets');
        $mail['action_title']   = __('eventmie-pro::em.login');
        $mail['action_url']     = route('eventmie.login');
        $mail['n_type']         = "user";

        /* Guest password reset notification */
        $msg                    = [];
        $msg[]                  = __('eventmie-pro::em.guest_password_reset');
        $mail['extra_lines']    = $msg;
        $mail['guest_checkout']   = $request->guest_checkout;
        $mail['guest_password']   = $guest_password;

        // notification for
        $notification_ids       = [
            1, // admin
            $user->id, // new registered user
        ];
        
        $users = User::whereIn('id', $notification_ids)->get();
        
        \App\Jobs\RegistrationEmailJob::dispatch($mail, $users, 'register')->delay(now()->addSeconds(10));
        /* Send email verification link */
        // $user->sendEmailVerificationNotification();
        /* Send email verification link */
        
        $user->markEmailAsVerified();

        // ====================== Notification ======================     

        if(setting('multi-vendor.verify_email') && empty($user->email_verified_at))
        {
            // $user->sendEmailVerificationNotification();
            
            return response()->json(['status' => true, 'user' => $user->only(['id', 'name', 'phone', 'email', 'avatar']),  'verify_email' => 0, 'is_verify_email' => setting('multi-vendor.verify_email')
            ]);

        }
       
        $stripe_secret_key     = null;
        if(!empty(setting('apps.stripe_public_key')) && !empty(setting('apps.stripe_secret_key')))
            $stripe_secret_key = $user->createSetupIntent()->client_secret;

        
        return response()->json(['status' => true, 'user' => $user->only(['id', 'name', 'phone', 'email',  'avatar']),
        'verify_email' => 1, 'is_verify_email' => setting('multi-vendor.verify_email'), 'stripe_secret_key' => $stripe_secret_key,
            'is_customer' => (\Auth::user()->hasRole(['organiser', 'admin']) ? 0 : 1)
        ]);
    }
    
}
