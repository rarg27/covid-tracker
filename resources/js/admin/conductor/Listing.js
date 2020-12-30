import AppListing from '../app-components/Listing/AppListing';

Vue.component('conductor-listing', {
    mixins: [AppListing],

    data() {
        return {
            showTerminalsFilter: true,
            terminalsMultiselect: {},

            filters: {
                terminals: [],
            },
        }
    },

    watch: {
        showTerminalsFilter: function (newVal, oldVal) {
            this.terminalsMultiselect = [];
        },
        terminalsMultiselect: function(newVal, oldVal) {
            this.filters.terminals = newVal.map(function(object) { return object['key']; });
            this.filter('terminals', this.filters.terminals);
        }
    }
});