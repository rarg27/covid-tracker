<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Conductor extends Authenticatable
{
    use FormattedTimestamp,
        HasApiTokens,
        SoftDeletes;

    protected $fillable = [
        'terminal_id',
        'name',
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'resource_url'
    ];

    public function terminal() : BelongsTo
    {
        return $this->belongsTo(Terminal::class, 'terminal_id', 'id');
    }

    /**
     * Auto-hash incoming password
     *
     * @param  string $password the incoming password
     */
    public function setPasswordAttribute($password)
    {
        if ($password !== null) {
            $password = Hash::make($password);
        }

        $this->attributes['password'] = $password;
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->attributes['password']);
    }

    public function getResourceUrlAttribute()
    {
        return url('/admin/conductors/'.$this->getKey());
    }
}
