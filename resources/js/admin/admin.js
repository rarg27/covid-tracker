import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';
import { WebCam } from "vue-web-cam";

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);
Vue.component('webcam', WebCam);

new Vue({
    mixins: [Admin],
});

// function takePicture() {
//     if (document.getElementById('btn_camera').innerHTML === 'Capture') {
//         Webcam.snap( function(data_uri) {
//             document.getElementById('camera').innerHTML = '<img src="'+data_uri+'"/>';
//             document.getElementById('picture').value = data_uri;
//             document.getElementById('btn_camera').innerHTML = 'Retake';
//         });
//     } else {
//         document.getElementById('picture').value = '';
//         document.getElementById('btn_camera').innerHTML = 'Capture';
//         initializeCamera();
//     }
// }
//
// function initializeCamera() {
//     Webcam.set({
//         width: 320,
//         height: 240,
//         image_format: 'jpeg',
//         jpeg_quality: 90
//     });
//     Webcam.attach('#camera');
// }
//
// window.initializeCamera = initializeCamera;
// window.takePicture = takePicture;