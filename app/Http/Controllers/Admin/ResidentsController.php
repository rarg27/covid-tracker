<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resident\BulkDestroyResident;
use App\Http\Requests\Admin\Resident\DestroyResident;
use App\Http\Requests\Admin\Resident\IndexResident;
use App\Http\Requests\Admin\Resident\StoreResident;
use App\Http\Requests\Admin\Resident\UpdateResident;
use App\Models\Resident;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ResidentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexResident $request
     * @return array|Factory|View
     */
    public function index(IndexResident $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Resident::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'address', 'birth_date', 'contact_number'],

            // set columns to searchIn
            ['id', 'name', 'address', 'contact_number']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.resident.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.resident.create');

        return view('admin.resident.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreResident $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreResident $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Resident
        $resident = Resident::create($sanitized);

        if ($picture = $request->get('picture')) {
            if ($picture != NULL) {
                $resident->addMediaFromBase64($picture)
                    ->toMediaCollection('picture');
            }
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/residents'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/residents/'.$resident->id.'/qrcode');
    }

    /**
     * Display the specified resource.
     *
     * @param Resident $resident
     * @throws AuthorizationException
     * @return void
     */
    public function show(Resident $resident)
    {
        $this->authorize('admin.resident.show', $resident);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resident $resident
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Resident $resident)
    {
        $this->authorize('admin.resident.edit', $resident);


        return view('admin.resident.edit', [
            'resident' => $resident,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateResident $request
     * @param Resident $resident
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateResident $request, Resident $resident)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Resident
        $resident->update($sanitized);

        if ($picture = $request->get('picture')) {
            if ($picture != NULL) {
                $resident->addMediaFromBase64($picture)
                    ->toMediaCollection('picture');
            }
        }

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/residents'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/residents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyResident $request
     * @param Resident $resident
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyResident $request, Resident $resident)
    {
        $resident->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyResident $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyResident $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Resident::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function qrCode(Resident $resident)
    {
        $this->authorize('admin.resident.qrcode', $resident);

        return view('admin.resident.qrcode', [
            'resident' => $resident,
        ]);
    }
}
