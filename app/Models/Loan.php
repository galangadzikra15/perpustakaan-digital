<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;

class Loan extends Model
{
    public function book()
{
    return $this->belongsTo(
        Book::class,
        'id_buku',
        'id_buku'
    );
}

public function member()
{
    return $this->belongsTo(
        Member::class,
        'NIM',
        'NIM'
    );
}

public function user()
{
    return $this->belongsTo(
        User::class,
        'id_user',
        'id_user'
    );
}
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [

        'id_buku',
        'NIM',
        'id_user',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'catatan'

    ];
}