<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nicolaslopezj\Searchable\SearchableTrait;

class TransportationLog extends Model
{
    use FormattedTimestamp,
        SearchableTrait;

    protected $fillable = [
        'resident_id',
        'terminal_id',
        'conductor_id',
        'driver_id'
    ];

    protected $searchable = [
        'columns' => [
            'residents.name' => 10,
            'terminals.name' => 8,
            'conductors.name' => 8,
            'drivers.name' => 8
        ],
        'joins' => [
            'residents' => ['transportation_logs.resident_id', 'residents.id'],
            'terminals' => ['transportation_logs.terminal_id', 'terminals.id'],
            'conductors' => ['transportation_logs.conductor_id', 'conductors.id'],
            'drivers' => ['transportation_logs.driver_id', 'drivers.id']
        ]
    ];

    public function resident() : BelongsTo
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }

    public function terminal() : BelongsTo
    {
        return $this->belongsTo(Terminal::class, 'terminal_id', 'id');
    }

    public function conductor() : BelongsTo
    {
        return $this->belongsTo(Conductor::class, 'conductor_id', 'id');
    }

    public function driver() : BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
