<template>
    <VueSlickCarousel 
        :autoplay="true"
        :autoplaySpeed="5000"
        :arrows="false" 
        :dots="false"
        :infinite="false"
        :slidesToShow="1"
        :paginationEnabled="false"
        :rtl="dir"
    >
        <div 
            v-for="(item, index) in banners"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:key="index"
            :class="'lgx-item-common'"
        >
            <div class="w-100">
                <div class="position-relative d-flex pt-lg-6 flex-column min-vh-xl-100">
                    <span class="position-absolute top-0 end-0 bottom-0 start-0 vignette-bg"
                        :style=" { backgroundImage: 'url(' + (`/storage/${item.image}`) + ')', backgroundSize: 'cover', backgroundPosition: '50%'} ">
                    </span>
                    <div class="position-relative d-flex flex-column justify-content-center pt-12 z-2">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- content -->
                                    <div class="py-lg-20 py-6 py-md-14 position-relative">
                                        <div class="text-center mb-10">
                                            <h1 class="text-white display-3 fw-bold mb-1"> {{ item.title }}</h1>
                                            <p class="lead text-white"> {{ item.subtitle }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </VueSlickCarousel>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

Vue.prototype.base_url = window.base_url;

export default {

    components: {
        VueSlickCarousel
    },
    props: [
        'banners',
        'is_logged',
        'is_customer',
        'is_organiser',
        'is_admin',
        'is_multi_vendor',
        'demo_mode',
        'check_session',
        's_host'
        
    ],

    
    data() {
        return {
            check       : 0,
            categories  : [],
            cities      : [],
            f_category  : '',
            f_city      : '',
            f_price     : '',
            route       : route,
            dir         : false,

        }
    },    

    methods: {
        // return route with event slug
        getRoute(name){
            return route(name);
        },

        verifyD(){
            this.check = this.check_session ? 1 : 0;
            
            if(this.check == 0)
            {
                axios.post('https://cblicense.classiebit.com/verifyd',{
                    domain : window.location.hostname,
                    s_host : this.s_host
                })
                .then(res => {
                    if(typeof res.data.status !== 'undefined' && res.data.status != 0)
                        this.checkSession();
                    else
                        window.location.href = base_url+"/404";
                    
                })
                .catch(error => {
                    
                });
            }
        },
        
        // check Session
        checkSession(){
            axios.post(route('eventmie.check_session'))
            .then(res => {
              
            }).catch(error => {
                
            });
        },

        // get categories
        getCategories(){
            axios.get(route('eventmie.myevents_categories'))
            .then(res => {
                if(res.status)
                   this.categories  = res.data.categories;
            })
            .catch(error => {
                
            });
        },
        // get cities
        getCities(){
            axios.get(route('eventmie.myevents_cities'))
            .then(res => {
                if(res.status)
                   this.cities  = res.data.cities;
            })
            .catch(error => {
                
            });
        },
        
        getDirection(){
            document.documentElement.dir == 'rtl' ? this.dir = true : this.dir = false;
        },
        


    },

    mounted() {
        this.verifyD();       
        this.getCategories();
        this.getCities();
        this.getDirection();
        console.log( document.documentElement.dir);
    }
}
</script>