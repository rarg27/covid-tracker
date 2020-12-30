import AppForm from '../app-components/Form/AppForm';

Vue.component('terminal-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                location:  '' ,
                
            }
        }
    }

});