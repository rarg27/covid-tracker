<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Conductor\BulkDestroyConductor;
use App\Http\Requests\Admin\Conductor\DestroyConductor;
use App\Http\Requests\Admin\Conductor\IndexConductor;
use App\Http\Requests\Admin\Conductor\StoreConductor;
use App\Http\Requests\Admin\Conductor\UpdateConductor;
use App\Models\Conductor;
use App\Models\Terminal;
use Brackets\AdminListing\Facades\AdminListing;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConductorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexConductor $request
     * @return array|Factory|View
     */
    public function index(IndexConductor $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Conductor::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'terminal_id', 'name', 'username'],

            // set columns to searchIn
            ['id', 'name', 'username'],

            function ($query) use ($request) {
                $query->with(['terminal']);
                if ($request->has('terminals')) {
                    $query->whereIn('terminal_id', $request->get('terminals'));
                }
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

        return view('admin.conductor.index', [
            'data' => $data,
            'terminals' => Terminal::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.conductor.create');

        return view('admin.conductor.create', [
            'terminals' => Terminal::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConductor $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreConductor $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
//        $sanitized['terminal_id'] = $request->getTerminalId();
        $sanitized['terminal_id'] = 1;
        \Log::debug($sanitized);

        // Store the Conductor
        $conductor = Conductor::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/conductors'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/conductors');
    }

    /**
     * Display the specified resource.
     *
     * @param Conductor $conductor
     * @throws AuthorizationException
     * @return void
     */
    public function show(Conductor $conductor)
    {
        $this->authorize('admin.conductor.show', $conductor);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Conductor $conductor
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Conductor $conductor)
    {
        $this->authorize('admin.conductor.edit', $conductor);


        return view('admin.conductor.edit', [
            'conductor' => $conductor,
            'terminals' => Terminal::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateConductor $request
     * @param Conductor $conductor
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateConductor $request, Conductor $conductor)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
//        $sanitized['terminal_id'] = $request->getTerminalId();
        $sanitized['terminal_id'] = 1;

        // Update changed values Conductor
        $conductor->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/conductors'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/conductors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyConductor $request
     * @param Conductor $conductor
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyConductor $request, Conductor $conductor)
    {
        $conductor->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyConductor $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyConductor $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    DB::table('conductors')->whereIn('id', $bulkChunk)
                        ->update([
                            'deleted_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ]);

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
