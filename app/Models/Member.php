<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'NIM';
    public $incrementing = false;
    protected $keyType = 'string';

    // HAPUS no_telepon, email, alamat dari sini
    protected $fillable = [
        'NIM',
        'nama',
        'angkatan',
        'jurusan',
        'fakultas'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'NIM', 'NIM');
    }
}