<template>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">


            <div class="card-header d-flex justify-content-between flex-wrap p-4 bg-white border-bottom-0">

                    <div>
                        <h1 class="fw-bold h2">{{ trans('em.manage') }} {{ trans('em.guests') }}</h1>
                        <!-- @lang('eventmie-pro::em.manage') @lang('eventmie-pro::em.guests') -->
                    </div>

                    <!-- Filters -->
                    <div class="d-flex">
                        <div class="me-2">
                            <button type="button" class="btn  btn-primary" @click="() => {create_glist = 1;}"
                                data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                <span><i class="fas fa-calendar-plus"></i> {{ trans('em.create') }} {{ trans('em.guestlist') }}</span>
                            </button>
                            <create-glist v-if="create_glist > 0" :create_glist="create_glist" :glist="glist" ></create-glist>
                        </div>

                        <div class="me-2">
                            <button type="button" class="btn  btn-secondary" @click="() => {add_guest = 1;}">
                                <span><i class="fas fa-calendar-plus"></i> {{ trans('em.create') }} {{ trans('em.guest') }}</span>
                            </button>
                            <add-guest v-if="add_guest > 0" :add_guest="add_guest" ></add-guest>
                        </div>
                    </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">

                        <table class="table text-wrap table-hover">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th>{{ trans('em.name') }}</th>
                                    <th>{{ trans('em.total') }} {{ trans('em.guests') }}</th>
                                    <th class="hidden-xs">{{ trans('em.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(glist, index) in glists" :key="index" >
                                    <td >{{ glist.name }}</td>
                                    <td >{{ glist.guests.length }}</td>
                                    <td>
                                        <div class="custom-dropdown " v-on:click="isOpen = isOpen === index ? null : index">
                                            <a class="icon-shape icon-lg bg-info rounded-3"  href="#" role="button" id="courseDropdown2"><i class="fas fa-ellipsis fa-lg" ></i> </a>
                                              <ul  class="dropdownmenu shadow-lg" v-if="isOpen === index">
                                                <li>
                                                <a class="btn btn-primary btn-sm" :href="exportGuestEmails(glist.id)" ><i class="fas fa-edit"></i> {{ trans('em.export')+' '+trans('em.email') }} </a>
                                                </li>

                                                <li>
                                                <a class="btn btn-primary btn-sm"  :href="viewGuests(glist.id)"><i class="fas fa-eye"></i> {{ trans('em.view') }} {{ trans('em.guests') }}</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-danger btn-sm" href="#" @click="deleteGlist(glist.id)"><i class="fas fa-trash-alt"></i> {{ trans('em.delete') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                </td>
                                </tr>
                                <tr v-if="glists.length <= 0"> <td class="text-center mt-5" colspan="3">{{ trans('em.guest_not_found')}}</td></tr>
                            </tbody>
                        </table>

                        <div class="px-4 pb-4" v-if="glists.length > 0">
                            <pagination-component v-if="pagination.last_page > 1" :pagination="pagination" :offset="pagination.total" :path="'myglists'" @paginate="getMyGlists()"></pagination-component>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

import PaginationComponent from '../../../../../eventmie-pro/resources/js/common_components/Pagination'

import mixinsFilters from '../../../mixins.js';

import CreateGlist from './CreateGlist';
import AddGuest from '../guests/AddGuest';


export default {
    props: [
        // pagination query string
        'page',
        'category'
    ],

    components: {
        PaginationComponent,
        CreateGlist,
        AddGuest,


    },

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            isOpen           : false,
            glists           : [],

            // for create glist
            create_glist     : 0,

            // for add to guestlist
            add_guest        : 0,

            // for send email
            glist_id         : 0,

            // for edit glist
            glist            : [],

            pagination: {
                'current_page': 1
            },

        }
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

        // get all glist with pagination
        getMyGlists() {
            axios.get(route('pagination_myglist')+'?page='+this.current_page)
            .then(res => {

                this.glists  = res.data.myglists.data;

                this.pagination = {
                    'total' : res.data.myglists.total,
                    'per_page' : res.data.myglists.per_page,
                    'current_page' : res.data.myglists.current_page,
                    'last_page' : res.data.myglists.last_page,
                    'from' : res.data.myglists.from,
                    'to' : res.data.myglists.to,
                    'links' : res.data.myglists.links,
                };
            })
            .catch(error => {

            });
        },

        // edit glist
        editGlist(glist = []){
            this.glist        = glist;
            this.create_glist = 1;

        },

        //delete glist

        deleteGlist(glist_id = 0){

            if(glist_id <= 0)
                return true;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    axios.post(route('delete_glist'),{
                        glist_id : glist_id,
                    })
                    .then(res => {
                        this.showNotification('success',  trans('em.delete')+' '+trans('em.successfully'));
                        // reload page
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    })
                    .catch(error => {

                    });

                }
            })


        },

        // return route with event slug
        viewGuests(id){
            return route('myguests_index', [id]);
        },

        exportGuestEmails($glist_id = null){
            return route('export_emails', [$glist_id])
        }

    },
    mounted() {
        this.getMyGlists();
    }
}
</script>
<style>
@media only screen and (min-width: 1200px) {
    .dropdownmenu {
        position: absolute;
        /* top: 200px; */
        right: 300px;
    }
}

@media only screen and (max-width: 1200px) {
    .dropdownmenu {
        position: absolute;
        top: -12px;
        right: 90px;
        z-index: 99999;
    }
}
</style>