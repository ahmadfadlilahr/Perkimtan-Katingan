<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'telepon',
        'tipe_pesan',
        'subjek',
        'isi_pesan',
        'status',
    ];
}
