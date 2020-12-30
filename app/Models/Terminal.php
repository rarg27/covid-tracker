<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Terminal extends Model
{
    use FormattedTimestamp;

    protected $appends = [
        'resource_url'
    ];

    public function conductors() : HasMany
    {
        return $this->hasMany(Conductor::class, 'terminal_id', 'id');
    }

    public function drivers() : HasMany
    {
        return $this->hasMany(Driver::class, 'driver_id', 'id');
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/terminals/'.$this->getKey());
    }
}
