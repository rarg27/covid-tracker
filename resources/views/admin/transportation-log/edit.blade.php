@extends('admin.layout.default')

@section('title', trans('admin.transportation-log.actions.edit', ['name' => $transportationLog->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <transportation-log-form
                :action="'{{ $transportationLog->resource_url }}'"
                :data="{{ $transportationLog->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.transportation-log.actions.edit', ['name' => $transportationLog->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.transportation-log.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </transportation-log-form>

        </div>
    
</div>

@endsection