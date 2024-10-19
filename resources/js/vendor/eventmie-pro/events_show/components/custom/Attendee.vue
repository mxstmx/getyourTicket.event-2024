<template>
    <div>
        <label class="form-label h6 mt-1 mb-0">#{{ quantity_index+1 }} {{trans('em.attendee')}}</label>
        <div class="row g-2">
            <div class="col">
                <input type="text" class="form-control form-control-sm border-2" style="height: auto !important;" :name="'name_'+ticket_index+'_'+quantity_index" v-model="$parent.name[ticket_index][quantity_index]" v-validate="'required'" :placeholder="trans('em.name')+'*'">
            </div>

            <div class="col">
                <input type="text" class="form-control form-control-sm border-2" style="height: auto !important;" :name="'phone_'+ticket_index+'_'+quantity_index" v-model="$parent.phone[ticket_index][quantity_index]" v-validate="'required'" :placeholder="trans('em.phone')+'*'">
            </div>

            <div class="col">
                <textarea class="form-control form-control-sm border-2" rows="1" style="height: auto !important;" :name="'address_'+ticket_index+'_'+quantity_index" v-model="$parent.address[ticket_index][quantity_index]" v-validate="'required'" :placeholder="trans('em.address')+'*'"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <span 
                    v-show="errors.has('name_'+ticket_index+'_'+quantity_index) || errors.has('name_'+ticket_index+'_'+quantity_index) || errors.has('address_'+ticket_index+'_'+quantity_index)" 
                    class="help text-danger"
                >{{ trans('em.attendee') }} {{ trans('em.required') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    inject: ['$validator'],
    
    props:['quantity_index', 'ticket_index'],
    
    methods:{
        
    },
    beforeDestroy() {
        // remove value from array on addendees dropdown decrement
        this.$parent.name[this.ticket_index].splice(-1,1);
        this.$parent.phone[this.ticket_index].splice(-1,1);
        this.$parent.address[this.ticket_index].splice(-1,1);
    }

}
</script>