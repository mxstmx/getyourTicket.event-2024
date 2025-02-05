<template>
    <div class="container">
        <div class="py-4 py-lg-5">

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <button type="button" class="btn btn-outline-primary btn-sm" @click="filter_toggle = !filter_toggle"><i class="fas fa-bars"></i></button>
                            {{ trans('em.filters') }}
                        </h4>

                        <div>
                            <button type="button" class="btn btn-outline-secondary btn-sm" @click="reset()"><i class="fas fa-redo"></i> {{ trans('em.reset_filters') }}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row  mt-3" v-show="filter_toggle">
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label  class="form-label" >{{ trans('em.search_venue') }} </label>
                        <input type="text" class="form-control" v-model="f_search" :placeholder="trans('em.search_venue_name')">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label" >{{ trans('em.country') }}</label>
                        <select class="form-control" name="country" v-model="f_country" >
                            <option  value="All">{{ trans('em.all') }}</option>
                            <option v-for="(country, index) in countries" :key ="index" :value="country.country_name">{{country.country_name}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label class="form-label" >{{ trans('em.city') }}</label>
                        <select class="form-control" name="city" v-model="f_city" :disabled="f_country == 'All'">
                            <option  value="All">{{ trans('em.all') }}</option>
                            <option v-for="(city, index) in cities" :key ="index" :value="city.city">{{city.city}} , {{city.state}} </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12"> 
                    <venue-listing :venues="venues" :currency="currency" :date_format="date_format"></venue-listing>
                    <div class="row" v-if="venues.length > 0">
                        <div class="col-12">
                            <pagination-component v-if="pagination.last_page > 1" :pagination="pagination" :offset="pagination.total" @paginate="checkEvents()"></pagination-component>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
                            
</template>

<script>

import _ from 'lodash';

import PaginationComponent from '../../../../../../eventmie-pro/resources/js/common_components/Pagination';
import VenueListing from './VenueListing';

import mixinsFilters from '../../../../mixins.js';
export default {
    props: [
        // pagination query string
        'page',
        'category',
        'search',
        'price',
        'city',
        'state',
        'country',
        'start_date',
        'end_date',
        'date_format'
    ],

    components: {
        PaginationComponent,
        VenueListing, 
    },
    
    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            venues           : [],
            categories       : [],
            pagination: {
                'current_page': 1
            },
            moment           : moment,
            date_range       : [],
            f_price          : '',
            
            // filters
            f_category       : 'All',
            f_search         : '',

            // filter by location
            f_city           : 'All', 
            f_state          : 'All',
            f_country        : 'All',
            countries        :  [],
            states           :  [],
            cities           :  [],

            currency         : null,

            f_start_date     : '',
            f_end_date       : '',
            item_count       : 2,
            // date shortucts like today, tommorrow
            shortcuts: [
                {
                    text: trans('em.today'),
                    onClick: () => {
                        this.date_range = [moment().toDate(), moment().toDate() ]
                    }
                },
                {
                    text: trans('em.tomorrow'),
                    onClick: () => {
                        this.date_range = [moment().add(1,'day').toDate(), moment().add(1,'day').toDate()]
                    }
                },
                {
                    text: trans('em.this_weekend'),
                    onClick: () => {
                        this.date_range = [moment().endOf("week").toDate(), moment().endOf("week").toDate()]
                    }
                },
                {
                    text: trans('em.this_week'),
                    onClick: () => {
                        this.date_range = [moment().startOf("week").toDate(), moment().endOf("week").toDate()]
                    }
                },
                {
                    text: trans('em.next_week'),
                    onClick: () => {
                        this.date_range = [moment().add(1, 'weeks').startOf("week").toDate(), moment().add(1, 'weeks').endOf("week").toDate()]
                    }
                },
                {
                    text: trans('em.this_month'),
                    onClick: () => {
                        this.date_range = [moment().startOf("month").toDate(), moment().endOf("month").toDate()]
                    }
                },
                {
                    text: trans('em.next_month'),
                    onClick: () => {
                        this.date_range = [moment().add(1, 'months').startOf("month").toDate(), moment().add(1, 'months').endOf("month").toDate()]
                    }
                },
            ],

            filter_toggle: false,
        }
        
    },
    watch: {
        '$route' (to, from) {
            this.debouncedgGetEvents();    
        },
    
        // filters

        // searching f_category 
        f_category: function () {
            if(this.f_category)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { category: this.f_category, page: 1  }) }).catch(()=>{});
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.category;
                this.$router.replace({ query });
            }
            
        },

        // seraching by f_search 
        f_search: function () {
            if(this.f_search)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { search: this.f_search, page: 1  }) }).catch(()=>{});
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.search;
                this.$router.replace({ query });
            }    
        },
        // searching by date 
        date_range: function () {
            var is_date_null = true;
            if(this.date_range)
            {
                // convert date range to server side date
                this.date_range.forEach(function(value, key) {
                    if(value != null) {
                        is_date_null = false;

                        if(key == 0)
                            this.f_start_date   =  this.convert_date(value); // convert local start_date to server date then searching by date
                        
                        if(key == 1)
                            this.f_end_date     =  this.convert_date(value); // convert local end_date to server date then searching by date
                    }
                }.bind(this));
                
                if(is_date_null == false) {
                    this.$router.push({ query: Object.assign({}, this.$route.query, { start_date: this.f_start_date, page: 1  }) }).catch(()=>{});
                    this.$router.push({ query: Object.assign({}, this.$route.query, { end_date: this.f_end_date, page: 1  }) }).catch(()=>{});
                } else {
                    this.f_start_date  = '';
                    this.f_end_date    = '';
                    let query        = Object.assign({}, this.$route.query);
                    delete query.start_date;
                    delete query.end_date;
                    this.$router.replace({ query });
                }
            }
        },
        // searching by f_price 
        f_price: function() {
            if(this.f_price)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { price: this.f_price, page: 1  }) }).catch(()=>{});
                
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.price;
                this.$router.replace({ query });
            }  
        },
        // seraching by f_city 
        f_city: function () {
            
            if(this.f_city)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { city: this.f_city, page: 1  }) }).catch(()=>{});
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.city;
                this.$router.replace({ query });
            }    
        },

        // seraching by f_state 
        f_state: function () {
            if(this.f_state)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { state: this.f_state, page: 1  }) }).catch(()=>{});
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.state;
                this.$router.replace({ query });
            }    
        },

        // searching f_country 
        f_country: function () {
        
            if(this.f_country)
            {
                let _this = this;

                if(_this.f_country == 'All')
                    _this.f_city = 'All';

                if(Object.entries(_this.countries).length > 0){
                    
                    let c     = Object.entries(_this.countries).find(obj => obj.city == _this.f_city); 
                    
                    if(c == undefined)
                        _this.f_city = 'All';
                
                }   
                    
                this.$router.push({ query: Object.assign({}, this.$route.query, { country: this.f_country, page: 1  }) }).catch(()=>{});
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.country;
                this.$router.replace({ query });
            }


        },
    },
    
    computed: {
        current_page() {
            // get page from route
            if(typeof this.page === "undefined")
                return 1;
            
            return this.page;
        },
    },
    methods: {
        checkEvents() {
       
        },
        // get all venues
        getVenue() {
            
            if(typeof this.f_start_date === "undefined") {
                this.f_start_date     = '';
            }
            if(typeof this.f_end_date === "undefined") {
                this.f_end_date     = '';
            }
            
            axios.get(route('eventmie.venues.index')+'?page='+this.current_page+'&category='+encodeURIComponent(this.f_category)+'&search='+this.f_search+'&start_date='
                        +this.f_start_date+'&end_date='+this.f_end_date+'&price='+this.f_price+'&city='+this.f_city+'&state='+this.f_state+'&country='+encodeURIComponent(this.f_country))
            .then(res => {
                this.currency   = res.data.venues.currency;
                this.venues     = res.data.venues.data.data;
                this.pagination = {
                    'total' : res.data.venues.total,
                    'per_page' : res.data.venues.per_page,
                    'current_page' : res.data.venues.current_page,
                    'last_page' : res.data.venues.last_page,
                    'from' : res.data.venues.from,
                    'to' : res.data.venues.to,
                    'links' : res.data.venues.links
                };
                this.countries = res.data.venues.countries,
                this.states    = res.data.venues.states,
                this.cities    = res.data.venues.cities
                // venues sorting funtion
                
            })
            .catch(error => {
                
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

        // serch event with 5 delay
        debouncedgGetEvents: _.debounce(function() {
            this.getVenue()     
        }, 1000),

        // reset searching fields
        reset(){
            this.$router.replace({});
            this.f_search        = '';
            this.f_category      = 'All';
            this.date_range      = '';
            this.f_start_date      = '';
            this.f_end_date        = '';
            this.f_price         = '';
            this.f_city          = 'All';
            this.f_state         = 'All';
            this.f_country       = 'All';
        },

      

        // set query string if have query string when page refresh
        setQueryString(){
            
            //set serarch
            this.f_search   = (typeof this.search !== 'undefined') ? decodeURIComponent(this.search) : '';

            // get category of title from welcome page's categories 
            this.f_category = this.category ? decodeURIComponent(this.category).replace(/\+/g, " ") : 'All';

            // set price
            this.f_price     = (typeof this.price !== 'undefined') ? decodeURIComponent(this.price) : '';

             // set city
            this.f_city      = (typeof this.city !== 'undefined') ? decodeURIComponent(this.city) : 'All';

             // set state
            this.f_state     = (typeof this.state !== 'undefined') ? decodeURIComponent(this.state) : 'All';

            // set country 
            this.f_country   = this.country ? decodeURIComponent(this.country).replace(/\+/g, " ") : 'All';

            // set date
            if((typeof this.start_date !== 'undefined') && (typeof this.end_date !== 'undefined' )){
                
                this.date_range   = [this.setDateTime(this.start_date), this.setDateTime(this.end_date) ];
            
                this.f_start_date = this.start_date;
                this.f_end_date   = this.end_date; 
            }     
            
             if(this.f_search != '' || this.f_city != 'All' || this.f_country != 'All' )
                this.filter_toggle = true;
            
        }   
        
    },
    mounted() {
        this.setQueryString();
        this.getVenue();
        this.getCategories();
        
    }
}
</script>