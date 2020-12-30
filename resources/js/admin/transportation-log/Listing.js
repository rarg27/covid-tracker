import AppListing from '../app-components/Listing/AppListing';

Vue.component('transportation-log-listing', {
    mixins: [AppListing],

    data() {
        return {
            dateRange: ''
        }
    },

    watch: {
        dateRange: function (newVal, oldVal) {
            if (newVal.includes('to')) {
                this.filter('date_range', newVal.replaceAll(' to ', ','))
            }
        }
    }
});