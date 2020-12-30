<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Terminal\BulkDestroyTerminal;
use App\Http\Requests\Admin\Terminal\DestroyTerminal;
use App\Http\Requests\Admin\Terminal\IndexTerminal;
use App\Http\Requests\Admin\Terminal\StoreTerminal;
use App\Http\Requests\Admin\Terminal\UpdateTerminal;
use App\Models\Terminal;
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

class TerminalsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTerminal $request
     * @return array|Factory|View
     */
    public function index(IndexTerminal $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Terminal::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'location'],

            // set columns to searchIn
            ['id', 'name', 'location']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.terminal.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.terminal.create');

        return view('admin.terminal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTerminal $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTerminal $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Terminal
        $terminal = Terminal::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/terminals'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/terminals');
    }

    /**
     * Display the specified resource.
     *
     * @param Terminal $terminal
     * @throws AuthorizationException
     * @return void
     */
    public function show(Terminal $terminal)
    {
        $this->authorize('admin.terminal.show', $terminal);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Terminal $terminal
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Terminal $terminal)
    {
        $this->authorize('admin.terminal.edit', $terminal);


        return view('admin.terminal.edit', [
            'terminal' => $terminal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTerminal $request
     * @param Terminal $terminal
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTerminal $request, Terminal $terminal)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Terminal
        $terminal->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/terminals'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/terminals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTerminal $request
     * @param Terminal $terminal
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTerminal $request, Terminal $terminal)
    {
        $terminal->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTerminal $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTerminal $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Terminal::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
