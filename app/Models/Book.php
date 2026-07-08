<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class Book extends Model
{
    public function loans()
{
    return $this->hasMany(
        Loan::class,
        'id_buku',
        'id_buku'
    );
}
    protected $primaryKey = 'id_buku';
    
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'sinopsis'
    ];
}
