<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Models\Role;


class Pharmacist extends Authenticatable implements JWTSubject
{
    use HasFactory, HasRoles;

    protected $guard_name = 'api';
    protected $table = "pharmacists";
    protected $fillable = ["username", "password"];
    protected $hidden = ["created_at", "updated_at", "id"];

    public function orders()
    {
        return $this->hasMany(Order::class, "pharmacist_id");
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
