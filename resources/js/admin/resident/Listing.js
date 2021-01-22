import AppListing from '../app-components/Listing/AppListing';

Vue.component('resident-listing', {
    mixins: [AppListing],

    data() {
        return {
            statusSelect: "*",
            filters: {
                status: "*"
            }
        }
    },

    watch: {
        statusSelect: function(newVal, oldVal) {
            this.filters.status = newVal;
            this.filter('status', this.filters.status);
        }
    },
    
    methods: {
        acceptResident: function acceptResident(resident) {
            var _this = this;

            this.$modal.show('dialog', {
                title: 'Accept?',
                text: `Accept ${resident.name} and send QR Code via email?`,
                buttons: [{ title: 'No.' }, {
                    title: '<span class="btn-dialog btn-success">Yes.<span>',
                    handler: function handler() {
                        _this.$modal.hide('dialog');
                        axios.post(resident.resource_url + '/accept', resident).then(function (response) {
                            _this.loadData();
                            _this.$notify({ type: 'success', title: 'Success!', text: response.data.message ? response.data.message : 'Successfully accepted.' });
                        }, function (error) {
                            _this.$notify({ type: 'error', title: 'Error!', text: error.response.data.message ? error.response.data.message : 'An error has occured.' });
                        });
                    }
                }]
            });
        },
        rejectResident: function rejectResident(resident) {
            var _this = this;

            this.$modal.show('dialog', {
                title: 'Reject?',
                text: `Reject ${resident.name}?`,
                buttons: [{ title: 'No.' }, {
                    title: '<span class="btn-dialog btn-success">Yes.<span>',
                    handler: function handler() {
                        _this.$modal.hide('dialog');
                        axios.post(resident.resource_url + '/reject', resident).then(function (response) {
                            _this.loadData();
                            _this.$notify({ type: 'success', title: 'Success!', text: response.data.message ? response.data.message : 'Successfully rejected.' });
                        }, function (error) {
                            _this.$notify({ type: 'error', title: 'Error!', text: error.response.data.message ? error.response.data.message : 'An error has occured.' });
                        });
                    }
                }]
            });
        },
    }
});