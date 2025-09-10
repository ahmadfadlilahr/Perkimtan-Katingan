<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gambar',
        'keterangan',
    ];

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        return asset('storage/galeri/' . $this->gambar);
    }

    /**
     * Scope for searching
     */
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            $query->where('keterangan', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
