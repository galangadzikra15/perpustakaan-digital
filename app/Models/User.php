<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public function loans()
{
    return $this->hasMany(
        Loan::class,
        'id_user',
        'id_user'
    );
}
    use HasApiTokens, HasFactory;

    protected $primaryKey = 'id_user';
    
    protected $fillable = [
        'username',
        'password',
        'nama',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}