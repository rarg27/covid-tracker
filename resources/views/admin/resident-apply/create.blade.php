@extends('admin.layout.master')

@section('title', trans('admin.resident.actions.apply'))

@section('header')
    <header class="app-header navbar">
        <div onclick='return false;'>
            @if(View::exists('admin.layout.logo'))
                @include('admin.layout.logo')
            @endif
        </div>
    </header>
@endsection

@section('content')

    <div class="app-body">

        <main class="main">

            <div class="container-fluid" id="app" :class="{'loading': loading}">
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications position="bottom right" :duration="2000" />
                </div>

                <div class="container-xl">

                    <div class="card">

                        <resident-apply-form
                                :action="'{{ url('residents/apply') }}'"
                                v-cloak
                                inline-template>

                            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

                                <div class="card-header">
                                    <i class="fa fa-plus"></i> {{ trans('admin.resident.actions.apply') }}
                                </div>

                                <div class="card-body">
                                    @include('admin.resident-apply.components.form-elements')
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                                        Apply
                                    </button>
                                </div>

                            </form>

                        </resident-apply-form>

                    </div>

                </div>

            </div>

        </main>

    </div>

@endsection