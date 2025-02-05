<?php

namespace App\Models;

use App\Models\Attendee;
use Illuminate\Support\Facades\DB;
use Classiebit\Eventmie\Models\Transaction;
use Classiebit\Eventmie\Models\Booking as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends BaseModel
{
    use HasFactory;

    protected $with = ['attendees', 'transaction'];

    // get booking for organiser
    public function get_organiser_bookings($params = [])
    {   
        //CUSTOM
        $bookings     = new Booking;
        $table        = $bookings->getTable();
        
        //GET ALL COLUMNS
        $columns      = \Schema::getColumnListing($table);
        
        $length       = $params['length'];
        
        
        //CUSTOM

        $query = Booking::query();
        
        // $query->select('bookings.*', 'CM.customer_paid')

        //CUSTOM
        $query->with(['attendees']);
        //CUSTOM
        
        $query->select('bookings.*', 'CM.customer_paid', 'E.online_location', 'E.youtube_embed', 'E.vimeo_embed', 'E.slug as event_slug', 'E.thumbnail as event_thumbnail')
            ->selectRaw("(SELECT E.online_location FROM events E WHERE E.id = bookings.event_id AND bookings.is_paid = 1  AND bookings.status = 1) online_location")
            ->from('bookings')
            ->leftJoin('events as E', 'E.id', '=', 'bookings.event_id')
            ->leftJoin('commissions as CM', 'CM.booking_id', '=', 'bookings.id');
            
            // in case of searching by between two dates
            if(!empty($params['start_date']) && !empty($params['end_date']))
            {
                $query ->whereDate('bookings.created_at', '>=' , $params['start_date']);
                $query ->whereDate('bookings.created_at', '<=' , $params['end_date']);
            }
            
            // in case of searching by start_date
            if(!empty($params['start_date']) && empty($params['end_date']))
                $query ->whereDate('bookings.created_at', $params['start_date']);

            
            //CUSTOM
            // in case of searching by between two dates
            if(!empty($params['event_start_date']) && !empty($params['event_end_date']))
            {
                $query ->whereDate('bookings.event_start_date', '>=' , $params['event_start_date']);
                $query ->whereDate('bookings.event_start_date', '<=' , $params['event_end_date']);
            }
            
            // in case of searching by start_date
            if(!empty($params['event_start_date']) && empty($params['event_end_date']))
                $query ->whereDate('bookings.event_start_date', $params['event_start_date']);
            
            //CUSTOM

            // in case of searching by event_id
            if($params['event_id'] > 0)
                $query->where(['bookings.event_id' => $params['event_id']]);

            
            // CUSTOM
            if(!empty($params['search']))
            {
                // ALL COLUMNS SEARCH
                
                    $query->where(function($query) use($columns, $params) {
                        foreach($columns as $key => $column)
                        {
                            $query->orWhere('bookings.'.$column, 'like', '%' . $params['search'] . '%' );
                        }
                    });
                    
                
            }
            //CUSTOM   
            
        return  $query->where([ 'bookings.organiser_id' => $params['organiser_id'] ])
                ->orderBy('id', 'desc')
                // ->paginate(10);
                // CUSTOM    
                ->paginate($length);
                // CUSTOM
    }

    // get booking for customer
    public function get_my_bookings($params = [])
    {   
        // return Booking::select('bookings.*')
        // CUSTOM
        $bookings     = new Booking;
        $table        = $bookings->getTable();
        
        //GET ALL COLUMNS
        $columns      = \Schema::getColumnListing($table);
        
        $length       = $params['length'];
        
        $query = Booking::query();
        
        
        $query->select('bookings.*', 'E.youtube_embed', 'E.vimeo_embed', 'E.slug as event_slug', 'E.excerpt as event_excerpt', 'E.venue as event_venue', 'E.thumbnail as event_thumbnail')
        // CUSTOM

        ->selectRaw("(SELECT E.online_location FROM events E WHERE E.id = bookings.event_id AND bookings.is_paid = 1  AND bookings.status = 1) online_location")
        ->from('bookings')
        ->leftJoin('events as E', 'E.id', '=', 'bookings.event_id');
 
        //CUSTOM
        // in case of searching by between two dates
        if(!empty($params['start_date']) && !empty($params['end_date']))
        {
            $query ->whereDate('bookings.created_at', '>=' , $params['start_date']);
            $query ->whereDate('bookings.created_at', '<=' , $params['end_date']);
        }
        
        // in case of searching by start_date
        if(!empty($params['start_date']) && empty($params['end_date']))
            $query ->whereDate('bookings.created_at', $params['start_date']);

        // in case of searching by between two dates
        if(!empty($params['event_start_date']) && !empty($params['event_end_date']))
        {
            $query ->whereDate('bookings.event_start_date', '>=' , $params['event_start_date']);
            $query ->whereDate('bookings.event_start_date', '<=' , $params['event_end_date']);
        }
        
        // in case of searching by start_date
        if(!empty($params['event_start_date']) && empty($params['event_end_date']))
            $query ->whereDate('bookings.event_start_date', $params['event_start_date']);
                
        // in case of searching by event_id
        if($params['event_id'] > 0)
            $query->where(['bookings.event_id' => $params['event_id']]);

        if(!empty($params['search']))
        {
            // ALL COLUMNS SEARCH
            
                $query->where(function($query) use($columns, $params) {
                    foreach($columns as $key => $column)
                    {
                        $query->orWhere('bookings.'.$column, 'like', '%' . $params['search'] . '%' );
                    }
                });
                
            
        }
        //CUSTOM   
            
        return  $query->where(['customer_id' => $params['customer_id'] ])
                ->orderBy('id', 'desc')
                // ->paginate(10);
                // CUSTOM    
                ->paginate($length);
                // CUSTOM
    }

    // only admin and organiser can get particular event's booking
    public function get_event_bookings($params = [], $select = ['*'])
    {
        // $booking = Booking::select($select)->where($params)->get();

        //CUSTOM
        $booking = Booking::with(['attendees' => function ($query) {
            $query->where(['status' => 1]);
        }, 'attendees.seat'])->where($params)->get();
        //CUSTOM
        
        return to_array($booking);
    }

    // organiser view booking of customer
    public function organiser_view_booking($params = [])
    {
        // return Booking::select('bookings.*')->from('bookings')
        //CUSTOM
        return Booking::with(['attendees' => function ($query) {
            $query->where(['status' => 1]);
        },'attendees.seat'])
        //CUSTOM
            ->where($params)
            ->first();  
    }

    // sum booked ticket quantity each booking date + each ticket id
    public function get_seat_availability_by_ticket($event_id = null)
    {
        return Booking::select('event_start_date', 'ticket_id', 'event_start_time')
                ->selectRaw("SUM(quantity) as total_booked")
                ->where("event_id", $event_id)
                ->where("status", 1)
                ->groupBy("event_start_date", "ticket_id")
                ->orderBy('ticket_id')
                ->get();
    }

    /**
     * Get the attendees for the bookings.
     */
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
        
    }

     /**
     * getTransaction
     *
     * @return void
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }


    /**
     *  total revenue count
     */

    public function total_revenue($user_id = null)
    {
        if(!empty($user_id))
        {
            return Booking::select([
                        DB::raw("SUM(net_price) as total_revenue"),
                        'currency'
                    ])->where(['organiser_id' => $user_id])->groupBy('currency')->get();
        }
        return Booking::select([
                        DB::raw("SUM(net_price) as total_revenue"),
                        'currency'
                    ])->groupBy('currency')->get();
    }

    
    
}
