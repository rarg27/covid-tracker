<div class="form-group row align-items-center" :class="{'has-danger': errors.has('resident_id'), 'has-success': fields.resident_id && fields.resident_id.valid }">
    <label for="resident_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.transportation-log.columns.resident_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.resident_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('resident_id'), 'form-control-success': fields.resident_id && fields.resident_id.valid}" id="resident_id" name="resident_id" placeholder="{{ trans('admin.transportation-log.columns.resident_id') }}">
        <div v-if="errors.has('resident_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('resident_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('terminal_id'), 'has-success': fields.terminal_id && fields.terminal_id.valid }">
    <label for="terminal_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.transportation-log.columns.terminal_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.terminal_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('terminal_id'), 'form-control-success': fields.terminal_id && fields.terminal_id.valid}" id="terminal_id" name="terminal_id" placeholder="{{ trans('admin.transportation-log.columns.terminal_id') }}">
        <div v-if="errors.has('terminal_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('terminal_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('conductor_id'), 'has-success': fields.conductor_id && fields.conductor_id.valid }">
    <label for="conductor_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.transportation-log.columns.conductor_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.conductor_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('conductor_id'), 'form-control-success': fields.conductor_id && fields.conductor_id.valid}" id="conductor_id" name="conductor_id" placeholder="{{ trans('admin.transportation-log.columns.conductor_id') }}">
        <div v-if="errors.has('conductor_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('conductor_id') }}</div>
    </div>
</div>


