<template>
    <div class="custom_model">
        <div class="modal show" v-if="register_modal > 0">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" v-if="guest_checkout">{{ trans('em.checkout_as_guest') }}</h1>
                        <h1 class="modal-title fs-5" v-else>{{ !is_login ? trans('em.register') : trans('em.login') }}</h1>
                        <button type="button" class="btn btn-sm bg-danger text-white close" @click="close()"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" >
                            <div class="modal-body pb-0">
                                    
                                <input type="hidden" :value="is_login ? 1 : 0" name="is_login">
                                <input type="hidden" :value="guest_checkout ? 1 : 0" name="guest_checkout">

                                <div class="mb-3" v-show="!is_login">
                                    <label class="form-label">{{ trans('em.name') }}</label>
                                    <input type="text" class="form-control"  name="name" v-model="name" v-validate="!is_login ? 'required' : '' ">
                                    <span v-show="errors.has('name')" class="help text-danger">{{ errors.first('name') }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label"> {{ trans('em.email') }}</label>
                                    <input type="text" class="form-control"  name="email" v-model="email" v-validate="'required|email'">
                                    <span v-show="errors.has('email')" class="help text-danger">{{ errors.first('email') }}</span>
                                </div>

                                <div class="mb-3" v-show="!is_login">
                                    <label class="form-label"> {{ trans('em.phone') }}</label>
                                    <input type="text" class="form-control"  name="phone" v-model="phone" v-validate="!is_login ? 'required' : '' " v-if="is_twilio > 0">
                                    <input type="text" class="form-control"  name="phone" v-model="phone" v-else>
                                    <span v-show="errors.has('phone')" class="help text-danger">{{ errors.first('phone') }}</span>
                                </div>

                                <div class="mb-2" v-show="!guest_checkout">
                                    <label class="form-label">{{ trans('em.password') }}</label>
                                    <input type="password" class="form-control"  name="password" v-model="password" v-validate="!guest_checkout ? 'required' : '' ">
                                    <span v-show="errors.has('password')" class="help text-danger">{{ errors.first('password') }}</span>
                                    <a v-show="is_login" :href="goto_route()" class="p-0">{{ trans('em.forgot_password') }}</a>
                                </div>

                            </div>

                            <div class="modal-footer border-0 pt-0">
                                <button type="submit" :class="{ 'disabled' : disable }"  :disabled="disable" class="btn btn-primary w-100"><i class="fas fa-check"></i> {{ trans('em.continue') }}</button>

                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <a class="small text-primary" type="button" @click.prevent="is_login = is_login ? false : true; guest_checkout = false">{{ !is_login ? trans('em.already_have_account')+trans('em.login') : trans('em.dont_have_account')+trans('em.register') }}</a>
    
                                        <a v-if="!guest_checkout" class="small text-primary" type="button" @click.prevent="guest_checkout = true; is_login = false" >{{  trans('em.checkout_as_guest')}}</a>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</template>

<script>


import mixinsFilters from '../../../../../../../eventmie-pro/resources/js/mixins.js';

import VeeValidate from "vee-validate";
Vue.use(VeeValidate);


export default {
    props: ["register_modal"],

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            name        : '',
            email       : '',
            is_twilio : is_twilio,
            phone     : '',
            password  : '',
            disable   : false,
            is_login  : true,
            guest_checkout : false
            
             
        }
    },

    methods: {
        // reset form and close modal
        close: function () {    
            this.$parent.register_modal    = 0;
            this.$parent.overflowHidden      = false;
        },

        // validate data on form submit
        validateForm(event) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.formSubmit(event);            
                }
            });
        },

        // show server validation errors
        serverValidate(serrors) {
            this.$validator.validateAll().then((result) => {
                this.$validator.errors.add(serrors);
            });
        },

        // submit form
        formSubmit(event) {
            
            // show loader
            this.showLoaderNotification(trans('em.processing'));

            // prepare form data for post request
            this.disable = true;

            // prepare form data for post request
            let _this    = this;
            let post_url = route('guest.register');
            let post_data = new FormData(this.$refs.form);
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // on success
                // use vuex to update global sponsors array
                if(res.data.status)
                {
                    
                    Swal.hideLoading();
                    this.disable = false;

                    var promise = new Promise(function(resolve, reject) { 
                        _this.$parent.register_user_id = res.data.user.id;
                        _this.$parent.stripe_secret_key  = res.data.stripe_secret_key;
                        _this.$parent.$parent.is_customer = res.data.is_customer
                        
                        resolve(); 
                    
                    }); 
                    
                    promise. 
                        then(function () { 
                            
                            _this.showNotification('success', trans('em.user')+' '+( _this.is_login ? trans('em.login') : trans('em.register'))+' '+trans('em.successfully'));
                            if(res.data.is_verify_email && !res.data.verify_email){
                                _this.showNotification('success', trans('em.email_info'));

                            }else{
                                _this.showNotification('success', trans('em.user')+' '+( _this.is_login ? trans('em.login') : trans('em.register'))+' '+trans('em.successfully'));


                                setTimeout(function(){ 

                                    if(_this.$parent.is_seatchart)
                                        window.location.reload();
                                    else
                                        _this.$parent.validateForm();
                                }, 1000);

                               
                               
                            }
                            _this.close(); 
                        }). 
                        catch(function (error) { 
                            console.log(error);
                            console.log('Some error has occured'); 
                    }); 

                    
                }    

            })
            .catch(error => {
                
                Swal.hideLoading();
                this.disable = false;

                let serrors = Vue.helpers.axiosErrors(error);
                
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        goto_route() {
            return route('eventmie.password.request');
        },

    },

    mounted(){
        this.$parent.$refs.modal_custom.scrollTo(0, 0);
        this.$parent.overflowHidden      = true;
    }

}
</script>