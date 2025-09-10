<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gambar',
        'judul',
        'subjudul',
        'tombol_teks',
        'tombol_url',
        'urutan',
        'status',
    ];
}
