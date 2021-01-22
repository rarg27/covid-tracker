@extends('admin.layout.default')

@section('title', trans('admin.conductor.actions.edit', ['name' => $conductor->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <conductor-form
                :action="'{{ $conductor->resource_url }}'"
                :data="{{ $conductor->toJson() }}"
                :terminals="{{ $terminals->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.conductor.actions.edit', ['name' => $conductor->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.conductor.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </conductor-form>

        </div>
    
</div>

@endsection