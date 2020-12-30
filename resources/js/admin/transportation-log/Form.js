import AppForm from '../app-components/Form/AppForm';

Vue.component('transportation-log-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                resident_id:  '' ,
                terminal_id:  '' ,
                conductor_id:  '' ,
                
            }
        }
    }

});