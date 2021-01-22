@extends('admin.layout.default')

@section('title', trans('admin.terminal.actions.edit', ['name' => $terminal->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <terminal-form
                :action="'{{ $terminal->resource_url }}'"
                :data="{{ $terminal->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.terminal.actions.edit', ['name' => $terminal->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.terminal.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </terminal-form>

        </div>
    
</div>

@endsection