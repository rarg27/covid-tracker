<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransportationLog\BulkDestroyTransportationLog;
use App\Http\Requests\Admin\TransportationLog\DestroyTransportationLog;
use App\Http\Requests\Admin\TransportationLog\IndexTransportationLog;
use App\Models\TransportationLog;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransportationLogsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTransportationLog $request
     * @return array|Factory|View
     */
    public function index(IndexTransportationLog $request)
    {
        \Log::debug($request->all());

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TransportationLog::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['created_at', 'resident_id', 'terminal_id', 'conductor_id', 'driver_id'],

            // set columns to searchIn
            ['residents.name', 'terminals.name', 'conductors.name', 'drivers.name'],

            function ($query) use ($request) {
                /** @var Builder $query */
                if ($request->has('date_range')) {
                    $range = $request->get('date_range');
                    $range = explode(',', $range);

                    $query->where('created_at', '>=', $range[0]);
                    $query->where('created_at', '<=', $range[1]);
                }

                if ($keyword = $request->input('search2')) {
                    $query->search($keyword);
                }

                $query->with(['resident', 'terminal', 'conductor', 'driver']);
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.transportation-log.index', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTransportationLog $request
     * @param TransportationLog $transportationLog
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTransportationLog $request, TransportationLog $transportationLog)
    {
        $transportationLog->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTransportationLog $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTransportationLog $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TransportationLog::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
