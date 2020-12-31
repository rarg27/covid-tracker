<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Resident;
use App\Models\Terminal;
use App\Models\TransportationLog;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = Arr::only($data, ['email', 'password']);

        if (!\Auth::attempt($credentials, true)) {
            throw new AuthenticationException;
        }

        return redirect('/home');
    }

    // RESIDENTS

    public function storeResident(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'brith_date' => 'required|date',
            'contact_number' => 'sometimes|string',
        ]);

        $resident = Resident::create($data);

        // TODO return
    }

    public function listResidents(Request $request)
    {
        $data = $request->validate([
            'search' => 'sometimes|string'
        ]);

        $query = Resident::query();

        if ($search = Arr::get($data, 'search')) {
            $query->search($search);
        }

        $residents = $query->get();

        // TODO return
    }

    // CONDUCTOR

    public function storeConductor(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'terminal_id' => 'required|integer|exists:terminals,id',
        ]);

        $conductor = Conductor::create($data);

        // TODO return
    }

    public function listConductors(Request $request)
    {
        $data = $request->validate([
            'terminal_id' => 'required|integer'
        ]);

        $query = Conductor::query();

        if ($terminalId = Arr::get($data, 'terminal_id')) {
            $query->whereTerminalId($terminalId);
        }

        $conductors = $query->get();

        // TODO return
    }

    public function getConductor($id)
    {
        $conductor = Conductor::findOrFail($id);

        // TODO return
    }

    // TERMINAL

    public function storeTerminal(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string'
        ]);

        $terminal = Terminal::create($data);

        // TODO return
    }

    public function listTerminals()
    {
        $terminals = Terminal::get();

        // TODO return
    }

    public function getTerminal($id)
    {
        $terminal = Terminal::findOrFail($id);

        // TODO return
    }

    // LOGS

    public function logList(Request $request)
    {
        $data = $request->validate([
            'page' => 'required|integer',
            'limit' => 'required|integer',
            'from' => 'sometimes|date',
            'to' => 'sometimes|required_with_all:from|date',
            'terminal_id' => 'sometimes|integer|exists:terminals,id',
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
            if ($terminalId = Arr::get($data, 'terminal_id')) {
                $query->whereTerminalId($terminalId);
            }

            if ($search = Arr::get($data, 'search')) {
                $query->search($search);
            }
        }

        $query->with('resident');

        $result = $query->paginate(Arr::get($data, 'limit'));

        // TODO return
    }
}
