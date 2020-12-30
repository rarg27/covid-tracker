<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'terminal_id'
    ];
    
    protected $appends = [
        'resource_url'
    ];

    public function terminal() : BelongsTo
    {
        return $this->belongsTo(Terminal::class, 'terminal_id', 'id');
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/drivers/'.$this->getKey());
    }
}
