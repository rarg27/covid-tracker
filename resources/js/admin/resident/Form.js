import AppForm from '../app-components/Form/AppForm';

Vue.component('resident-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                address:  '' ,
                birth_date:  '' ,
                contact_number:  '' ,
                picture: '' ,
            },
            device: null,
            deviceId: null,
        }
    },
    methods: {
        onCapture() {
            if (this.$refs.btn_camera.innerHTML === 'Capture') {
                this.form.picture = this.$refs.webcam.capture();
                this.$refs.webcam.pause();
                this.$refs.btn_camera.innerHTML = 'Retake';
            } else {
                this.form.picture = '';
                this.$refs.webcam.resume();
                this.$refs.btn_camera.innerHTML = 'Capture';
            }
        },
        onCameras(cameras) {
            this.device = cameras[0];
            this.deviceId = cameras[0].deviceId;
        }
    }

});