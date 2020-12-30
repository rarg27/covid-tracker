@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.resident.actions.edit', ['name' => $resident->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <resident-form
                :action="'{{ $resident->resource_url }}'"
                :data="{{ $resident->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.resident.actions.edit', ['name' => $resident->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.resident.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </resident-form>

        </div>
    
</div>

@endsection

{{--<script>--}}
{{--    window.onload = function () {--}}
{{--        window.initializeCamera();--}}
{{--    }--}}
{{--</script>--}}