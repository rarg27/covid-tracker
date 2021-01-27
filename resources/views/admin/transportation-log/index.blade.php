@extends('admin.layout.default')

@section('title', trans('admin.transportation-log.actions.index'))

@section('body')

    <transportation-log-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/transportation-logs') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.transportation-log.actions.index') }}
{{--                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/transportation-logs/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.transportation-log.actions.create') }}</a>--}}
                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-start">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search2', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search2', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">
                                            
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="col col-lg-3 col-xl-3 form-group">
                                        <datetime
                                            v-model="dateRange"
                                            placeholder="Select date range"
                                            :config="{mode: 'range'}">
                                        </datetime>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'time'">Time</th>
                                        <th is='sortable' :column="'resident_id'">{{ trans('admin.transportation-log.columns.resident_id') }}</th>
                                        <th is='sortable' :column="'terminal_id'">{{ trans('admin.transportation-log.columns.terminal_id') }}</th>
                                        <th is='sortable' :column="'driver_id'">{{ trans('admin.transportation-log.columns.driver_id') }}</th>
                                        <th is='sortable' :column="'conductor_id'">{{ trans('admin.transportation-log.columns.conductor_id') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="6">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/transportation-logs')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/transportation-logs/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                    <td>@{{ item.created_at }}</td>
                                        <td>@{{ item.resident.name }}</td>
                                        <td>@{{ item.terminal.name }}</td>
                                        <td>@{{ item.driver.name }}</td>
                                        <td>@{{ item.conductor.name }}</td>
                                        
                                        <td>
                                            <div class="row no-gutters">
{{--                                                <div class="col-auto">--}}
{{--                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>--}}
{{--                                                </div>--}}
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
{{--                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>--}}
{{--                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/transportation-logs/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.transportation-log.actions.create') }}</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transportation-log-listing>

@endsection