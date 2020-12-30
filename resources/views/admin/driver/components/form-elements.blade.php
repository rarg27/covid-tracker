<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('terminal_id'), 'has-success': this.fields.terminal_id && this.fields.terminal_id.valid }">
    <label for="terminal_id"
           class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.driver.columns.terminal_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <multiselect
                v-model="form.terminal"
                :options="terminals"
                :multiple="false"
                track-by="id"
                label="name"
                tag-placeholder="{{ __('Select Terminal') }}"
                placeholder="{{ __('Terminal') }}">
        </multiselect>

        <div v-if="errors.has('terminal_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('terminal_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.driver.columns.name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.driver.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>