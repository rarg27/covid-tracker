@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.driver.actions.edit', ['name' => $driver->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <driver-form
                :action="'{{ $driver->resource_url }}'"
                :data="{{ $driver->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.driver.actions.edit', ['name' => $driver->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.driver.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </driver-form>

        </div>
    
</div>

@endsection