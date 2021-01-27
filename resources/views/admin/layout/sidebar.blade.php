<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
{{--            <li class="nav-item"><a class="nav-link" href="{{ url('admin/terminals') }}"><i class="nav-icon icon-direction"></i> {{ trans('admin.terminal.title') }}</a></li>--}}
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/conductors') }}"><i class="nav-icon icon-user"></i> {{ trans('admin.conductor.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/transportation-logs') }}"><i class="nav-icon icon-cursor-move"></i> {{ trans('admin.transportation-log.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/residents') }}"><i class="nav-icon icon-people"></i> {{ trans('admin.resident.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/drivers') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.driver.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

{{--            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>--}}
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
