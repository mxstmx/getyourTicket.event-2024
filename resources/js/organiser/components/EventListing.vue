<template>
    <div class="row">
        <div
            v-match-heights="{
                el: ['h5.sub-title'],  // Array of selectors to fix
            }"
            v-for="(event, index) in events" 
            :key="index"
            :class="'col-md-12 col-12 mb-5'"
        >

                <!-- listing block -->
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="position-relative mb-3 mb-lg-0">
                            <a  :href="eventSlug(event.slug)" class="text-inherit">
                                <div class="back-image rounded-3 img-hover" :style="{ 'background-image': 'url(/storage/' + event.thumbnail + ')', height:'180px' } "></div>
                            </a>
                            <span class="d-inline-flex badge bg-primary position-absolute top-0 ms-1 mt-2 start-0">
                                {{ changeDateFormat(userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'), "YYYY-MM-DD") }}                        
                            </span>


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
                    </div>
                    <div class="col-md-5 col-12 ">
                        <div>
                            <div class="rounded-bottom border-0 mb-lg-0">
                                <div class="mt-3 mb-0">
                                    <span v-if="event.repetitive" class="d-inline-flex btn btn-sm border-dark f-small mb-1 fw-medium">{{ trans('em.repetitive') }}</span>
                                    <span class="d-inline-flex btn btn-sm border-dark f-small mb-1 fw-medium" v-if="event.online_location">{{ trans('em.online') }}</span>
                                    <span class="d-inline-flex btn btn-sm border-dark f-small mb-1 fw-medium" v-if="!event.repetitive">{{ trans('em.one_t_event')  }}</span>

                                    <!-- simple events means without repetitive who ended -->
                                    <span class="d-inline-flex btn btn-sm border-dark f-small mb-1 fw-medium"
                                        v-if="!event.repetitive && moment().format('YYYY-MM-DD') > 
                                            userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')"
                                    >
                                        {{ trans('em.ended') }}
                                    </span>


                                    <!-- repetitive events who Ended -->
                                    <div v-if="event.repetitive && moment().format('YYYY-MM-DD') > userTimezone(event.end_date+' '+event.end_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')">
                                        <span class="d-inline-flex btn btn-sm border-dark f-small mb-1 fw-medium">{{ trans('em.ended') }}&nbsp;{{ trans('em.event') }}</span>
                                    </div>

                                    <h5 class="text-left p-0 m-0">
                                        <a  :href="eventSlug(event.slug)" class="text-inherit">
                                        {{ event.title.substring(0, 30)+
                                        `${event.title.length > 30 ? '...' : '' }`
                                        }}
                                        </a>
                                    </h5>
                                </div>
                                <div class="text-sm mb-2">
                                    {{ event.category_name }}
                                </div>
                                <div class="text-sm">
                                    {{ event.excerpt }}
                                </div>

                                <div class="text-sm d-flex justify-content-between mt-2"
                                    v-for="(ticket, index1) in event.tickets"
                                    :key="index1"
                                    v-if="index1 < 1"
                                >
                                    <div class="font-weight-semi-bold fw-light text-dark">
                                        <span>
                                            <i class="fas fa-map-marker-alt"></i>&nbsp;{{event.city}}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="h6">{{`${ event.currency ? ticket.price+' '+ event.currency :  ticket.price+' '+ currency}` }}</span>
                                        <span class="text-sm font-weight-semi-bold ms-1" >
                                            / {{ ticket.title.substring(0, 15)+`${ticket.title.length > 15 ? '..' : '' }` }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="d-grid gap-2 mt-5">
                            <a  :href="eventSlug(event.slug)" class="btn btn-lg btn-dark rounded-2 w-100">
                            {{trans('em.tickets')}}&emsp;<i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- listing block  -->
        </div>
    </div>


</template>

<script>

import mixinsFilters from '../../mixins.js';

//  CUSTOM
import VueCountdown from '@chenfengyuan/vue-countdown';
//  CUSTOM

export default {

    //  CUSTOM
    components: {
        VueCountdown,
    },
    //  CUSTOM
    props: ['events', 'currency', 'date_format'],


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

        watch: {
            events: function () {
                this.not_found = false;
                if(this.events.length <= 0)
                    this.not_found = true;
            
            },
            
        },


    },

    mounted(){
        console.log()
    }

}
</script>