import AppForm from '../app-components/Form/AppForm';

Vue.component('driver-form', {
    mixins: [AppForm],
    props: [
        'terminals'
    ],
    data: function() {
        return {
            form: {
                // terminal:  '' ,
                name:  '' ,
                
            }
        }
    }

});