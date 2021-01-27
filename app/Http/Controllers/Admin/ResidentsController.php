<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resident\BulkDestroyResident;
use App\Http\Requests\Admin\Resident\DestroyResident;
use App\Http\Requests\Admin\Resident\IndexResident;
use App\Http\Requests\Admin\Resident\StoreResident;
use App\Http\Requests\Admin\Resident\UpdateResident;
use App\Jobs\GenerateQrCodeID;
use App\Mail\QRCodeEmail;
use App\Models\Resident;
use Brackets\AdminListing\Facades\AdminListing;
use Brackets\AdminUI\WysiwygMedia;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

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
        $data = AdminListing::create(Resident::class)
            ->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'address', 'birth_date', 'contact_number', 'status', 'id_type', 'id_value'],

            // set columns to searchIn
            ['id', 'name', 'address', 'contact_number', 'id_value'],

            function (Builder $query) use ($request) {
                if ($request->has('status')) {
                    if ($request->input('status') != "*") {
                        $query->where('status', intval($request->input('status')));
                    }
                }
            }
        );

        /** @var LengthAwarePaginator|Collection $data */
        $data->each(function (Resident $resident) {
            switch ($resident->status) {
                case 0:
                    $resident->status = "Pending";
                    break;
                case 1:
                    $resident->status = "Accepted";
                    break;
                default:
                    $resident->status = "Rejected";
            }

            $resident->id_type = trans('admin.resident.id_type.'.$resident->id_type);
        });

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
     * Show the form for resident application.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function apply()
    {
        return view('admin.resident-apply.create');
    }

    public function accept(Resident $resident)
    {
        $resident->status = 1;

        $resident->save();

        dispatch(new GenerateQrCodeID($resident));

        if (\request()->ajax()) {
            return [
                'redirect' => url('admin/residents'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/residents');
    }

    public function applySuccess()
    {
        return view('admin.resident-apply.success', ['name' => \request('name')]);
    }

    public function reject(Resident $resident)
    {
        $resident->status = 2;

        $resident->save();

        if (\request()->ajax()) {
            return [
                'redirect' => url('admin/residents'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/residents');
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

        if (empty($request->input('id_picture'))) {
            throw new ConflictHttpException('ID Picture is required.');
        }

        if (
        Resident::where('contact_number', $sanitized['contact_number'])
            ->exists()
        ) {
            throw new ConflictHttpException('Contact number is already associated with another user.');
        }

        if (
            Resident::where('email', $sanitized['email'])
                ->exists()
        ) {
            throw new ConflictHttpException('Email is already associated with another user.');
        }

        if (
            Resident::where('id_type', $sanitized['id_type'])
                ->where('id_value', $sanitized['id_value'])
                ->exists()
        ) {
            throw new ConflictHttpException('The ID is already associated with another user.');
        }

        // Store the Resident
        $resident = Resident::create($sanitized);

        $resident->processMedia(collect(request()->only($resident->getMediaCollections()->map->getName()->toArray())));

//        if ($picture = $request->get('picture')) {
//            if ($picture != NULL) {
//                $resident->addMediaFromBase64($picture)
//                    ->toMediaCollection('picture');
//            }
//        }

        $redirect = 'residents/apply/success?name='.explode(' ', trim($resident->name))[0];

        if ($request->ajax()) {
//            return ['redirect' => url('admin/residents'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
            return ['redirect' => url($redirect), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

//        return redirect('admin/residents/'.$resident->id.'/qrcode');
        return redirect($redirect);
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

    public function idPicture(Resident $resident)
    {
        $this->authorize('admin.resident.qrcode', $resident);

        \Log::debug($resident);

        return view('admin.resident.idpicture', [
            'resident' => $resident,
        ]);
    }

    /**
     * @param Request $request
     * @throws AuthorizationException
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('', ['disk' => 'uploads']);

            return response()->json(['path' => $path], 200);
        }

        return response()->json(trans('brackets/media::media.file.not_provided'), 422);
    }
}
