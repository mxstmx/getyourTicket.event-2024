<template>

    <div class="px-2 py-2 w-100">
        <!-- listing block -->
        <div class="event-card mb-4 overflow-hidden">
            <div class="position-relative img-hover">
                
                
                <a  :href="eventSlug(event.slug)" class="text-inherit">
                    <img :src="'/storage/'+event.thumbnail" class="img-fluid w-100 rounded-4" :style="{height:'250px', width:'100%'}"/>
                </a>

                <div class="rounded-3 bg-white shadow-lg border-light-md border-1 position-absolute top-0 start-0 m-2 p-2 d-flex flex-column align-items-center justify-content-center">
                    <p class="fs-4 fw-bold m-0 p-0 lh-1" style="color: #2176ff">
                        {{ userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('DD') }}                        
                    </p>
                    <div class="">
                        {{ userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('MMM,YYYY') }}                        
                    </div>
                </div>


                <!-- CUSTOM -->
                <div v-if="event.sale_tickets.length > 0">
                    <div class="badge bg-gradient position-absolute bottom-0 mx-1  mb-2 start-0" v-if="event.sale_tickets[0].sale_start_date != null">
                        <div class="text-sm d-flex justify-content-between" v-if="
                            userTimezone(event.sale_tickets[0].sale_start_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') <= moment().tz(Intl.DateTimeFormat().resolvedOptions().timeZone).format('YYYY-MM-DD HH:mm:ss') &&
                            userTimezone(event.sale_tickets[0].sale_end_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') > moment().tz(Intl.DateTimeFormat().resolvedOptions().timeZone).format('YYYY-MM-DD HH:mm:ss')">

                            <div>
                                <span class="font-weight-semi-bold text-white">
                                    {{ trans('em.on_sale') }}
                                </span>
                            </div>

                            <div>
                                <i class='fas fa-clock fa-spin text-danger  ms-2'></i>
                                <span class="font-weight-semi-bold fw-light text-white">
                                    <vue-countdown :time="timerOnSale(event.sale_tickets[0].sale_start_date, event.sale_tickets[0].sale_end_date)" v-slot="{ days, hours, minutes, seconds }">
                                    {{ days }} {{ trans('em.days') }}, {{ hours }} : {{ minutes }} : {{ seconds }} {{ trans('em.left') }}
                                    </vue-countdown>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- CUSTOM -->

            </div>

            <div class="row">
                <div class="d-flex align-items-center justify-content-start flex-wrap gap-2 text-gray-900 my-3 mx-1">
                    <span v-if="event.repetitive" class="d-inline-flex border-1 border border-info bg-info-subtle px-2 fs-7 text-center event-tag">{{ trans('em.repetitive') }}</span>
                    <span class="d-inline-flex border-1 border border-success bg-success-subtle fs-7 text-center event-tag" v-if="event.online_location">{{ trans('em.online') }}</span>
                    <span class="d-inline-flex border-1 border border-success bg-success-subtle fs-7 text-center event-tag" v-if="!event.repetitive">{{ trans('em.one_t_event')  }}</span>

                    <!-- simple events means without repetitive who ended-->
                    <span class="d-inline-flex border-1 border border-danger bg-danger-subtle fs-7 text-center event-tag"
                        v-if="!event.repetitive && moment().format('YYYY-MM-DD') > 
                            userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')"
                    >
                        {{ trans('em.ended') }}
                    </span>


                    <!-- repetitive events who Ended -->
                    <div v-if="event.repetitive && moment().format('YYYY-MM-DD') > userTimezone(event.end_date+' '+event.end_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')">
                        <span class="d-inline-flex border-1 border border-danger bg-danger-subtle fs-7 text-center event-tag">{{ trans('em.ended') }}&nbsp;{{ trans('em.event') }}</span>
                    </div>
                </div>
            
                <!-- <div class="text-sm">
                    {{ event.category_name }}
                </div> -->

                <div class="col-12">
                    <a  :href="eventSlug(event.slug)" class="fs-3 lh-1 p-0 m-0 px-2 fw-medium text-gray-900">
                        {{ event.title.substring(0, 23)+ `${event.title.length > 23 ? '...' : '' }`}}
                    </a>

                    <p class="pill-text p-0 my-1 fw-normal px-2 text-gray-700 fs-5">
                        <i class="fas fa-location-dot me-1"></i>&nbsp;{{event.city}}
                    </p>
                </div>

                <div class="d-flex gap-1 align-items-center justify-content-end my-2"
                    v-for="(ticket, index1) in event.tickets"
                    :key="index1"
                    v-if="index1 < 1"
                >
                    <div>
                        <span class="sub-text fw-medium lh-1 text-success">{{`${ event.currency ? ticket.price+' '+ event.currency :  ticket.price+' '+ currency}` }}</span>
                        <span class="" >
                            / {{ ticket.title.substring(0, 15)+`${ticket.title.length > 15 ? '..' : '' }` }}
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <a  :href="eventSlug(event.slug)" class="btn btn-gradient rounded-3 w-100">
                        <i class="fa fa-ticket me-1"></i> {{ trans('em.buy_ticket') }}
                    </a>
                </div>

            </div>
        </div>
        <!-- listing block -->
    </div>


</template>

<script>

import mixinsFilters from '../../../mixins.js';

//  CUSTOM
import VueCountdown from '@chenfengyuan/vue-countdown';
//  CUSTOM

export default {

    //  CUSTOM
    components: {
        VueCountdown,
    },
    //  CUSTOM
    props: ['event', 'currency', 'date_format'],


    mixins:[
        mixinsFilters
    ],

    data() {
        return {
        }
    },

    methods:{

        // check free tickets of events
        checkFreeTickets(event_tickets = []){
            let free = false;
            event_tickets.forEach(function(value, key) {
                if(parseFloat(value.price) <= parseFloat(0))
                {
                    free = true;
                }
            });
            return free;
        },


        // return route with event slug
        eventSlug: function eventSlug(slug) {
            return route('eventmie.events_show', [slug]);
        },

        /* CUSTOM */
        timerOnSale(sale_start_date = null, sale_end_date = null){
            if(sale_start_date == null || sale_end_date == null)
                return true;

            var local_tz = Intl.DateTimeFormat().resolvedOptions().timeZone;

            var a    = this.userTimezone(sale_end_date, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY HH:mm:ss');
            var b    = moment().tz(local_tz).format('DD/MM/YYYY HH:mm:ss');
            var ms   = 0; // milliseconds

            if(moment(a,"DD/MM/YYYY HH:mm:ss") > moment(b,"DD/MM/YYYY HH:mm:ss")){
                ms = moment(a,"DD/MM/YYYY HH:mm:ss").tz(local_tz).diff(moment(b,"DD/MM/YYYY HH:mm:ss").tz(local_tz)); //milliseconds

            }

            return ms;
        },
        /* CUSTOM */


    },

    mounted(){
    }

}
</script>