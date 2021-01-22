<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.resident.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address'), 'has-success': fields.address && fields.address.valid }">
    <label for="address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.address') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address'), 'form-control-success': fields.address && fields.address.valid}" id="address" name="address" placeholder="{{ trans('admin.resident.columns.address') }}">
        <div v-if="errors.has('address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('birth_date'), 'has-success': fields.birth_date && fields.birth_date.valid }">
    <label for="birth_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.birth_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.birth_date" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('birth_date'), 'form-control-success': fields.birth_date && fields.birth_date.valid}" id="birth_date" name="birth_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('birth_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('birth_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.email') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.resident.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('contact_number'), 'has-success': fields.contact_number && fields.contact_number.valid }">
    <label for="contact_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.contact_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.contact_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('contact_number'), 'form-control-success': fields.contact_number && fields.contact_number.valid}" id="contact_number" name="contact_number" placeholder="{{ trans('admin.resident.columns.contact_number') }}">
        <div v-if="errors.has('contact_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('contact_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_type'), 'has-success': fields.id_type && fields.id_type.valid }">
    <label for="id_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.id_type') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select id="contact_number" name="contact_number" class="form-control" v-model="form.id_type" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_type'), 'form-control-success': fields.id_type && fields.id_type.valid}">
            <option value="sss">SSS</option>
            <option value="umid">UMID</option>
            <option value="philhealth">PhilHealth ID</option>
            <option value="drivers_license">Driver's License</option>
            <option value="voters">Voter's ID</option>
            <option value="senior_citizen">Senior Citizen ID</option>
        </select>
        <div v-if="errors.has('id_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_value'), 'has-success': fields.id_value && fields.id_value.valid }">
    <label for="id_value" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.id_value') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_value" v-validate="'required|alpha_dash'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_value'), 'form-control-success': fields.id_value && fields.id_value.valid}" id="id_value" name="id_value" placeholder="{{ trans('admin.resident.columns.id_value') }}">
        <div v-if="errors.has('id_value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_value') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="id_picture" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.resident.columns.id_picture') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        @include('admin.resident-apply.includes.media-uploader', [
            'mediaCollection' => app(App\Models\Resident::class)->getMediaCollection('id_picture'),
            'label' => 'ID Picture'
        ])
    </div>
</div>

{{--<div class="form-group row align-items-center">--}}
{{--    <label for="camera" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Picture</label>--}}
{{--    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
{{--        <p v-if="device">@{{ device.label }}</p>--}}
{{--        <webcam--}}
{{--            ref="webcam"--}}
{{--            :device-id="deviceId"--}}
{{--            width="320"--}}
{{--            height="240"--}}
{{--            @cameras="onCameras">--}}
{{--        </webcam>--}}
{{--        <div><button id="btn_camera" ref="btn_camera" type="button" @click="onCapture">Capture</button></div>--}}
{{--    </div>--}}
{{--</div>--}}

