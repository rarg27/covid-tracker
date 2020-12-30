import AppForm from '../app-components/Form/AppForm';

Vue.component('conductor-form', {
    mixins: [AppForm],
    props: [
        'terminals'
    ],
    data: function() {
        return {
            form: {
                terminal:  '' ,
                name:  '' ,
                username:  '' ,
                password:  '' ,
                
            }
        }
    }

});