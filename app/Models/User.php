<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use FormattedTimestamp;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
}
