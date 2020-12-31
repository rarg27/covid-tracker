<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Driver;
use App\Models\Resident;
use App\Models\TransportationLog;
use App\Util;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ConductorController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $conductor = Conductor::whereUsername($data['username'])
            ->with('terminal')
            ->firstOrNew();

        if (!$conductor->exists || !Hash::check(Arr::get($data, 'password'), $conductor->password)) {
            throw new AuthenticationException;
        }

        return response()->json(array_merge(
            $conductor->toArray(),
            ['token' => $conductor->createToken('token')->plainTextToken]
        ));
    }

    public function log(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'driver_id' => 'required|integer'
        ]);

        /** @var Conductor $conductor */
        $conductor = $request->user();

        $resident = Resident::findOrFail(Arr::get($data, 'id'));
        $driver = Driver::findOrFail(Arr::get($data, 'driver_id'));

        $log = TransportationLog::create([
            'resident_id' => $resident->id,
            'terminal_id' => $conductor->terminal_id,
            'conductor_id' => $conductor->id,
            'driver_id' => $driver->id,
        ]);

        return response()->json($log);
    }

    public function logList(Request $request)
    {
        $data = $request->validate([
            'page' => 'required|integer',
            'limit' => 'required|integer',
            'from' => 'sometimes|date',
            'to' => 'sometimes|required_with_all:from|date',
            'search' => 'sometimes|string',
            'resident_id' => 'sometimes|integer|exists:residents,id'
        ]);

        $query = TransportationLog::query();

        if ($from = Arr::get($data, 'from')) {
            $to = Arr::get($data, 'to');
            $query->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to);
        }

        if ($residentId = Arr::get($data, 'resident_id')) {
            $query->whereResidentId($residentId);
        } else {
            if ($search = Arr::get($data, 'search')) {
                $query->search($search);
            }
        }

        $query->orderByDesc('created_at');

        $query->with([
            'resident:id,name,address,contact_number',
            'terminal:id,name',
            'conductor:id,name',
            'driver:id,name'
        ]);

        $result = $query->paginate(Arr::get($data, 'limit'));

        return response()->json(Util::cleanPaginate($result));
    }

    public function drivers()
    {
        /** @var Conductor $conductor */
        $conductor = \request()->user();

        return Driver::whereTerminalId($conductor->terminal_id)->get(['id', 'name']);
    }
}
