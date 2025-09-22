<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'user_id',
        'isi',
        'gambar',
        'status',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/berita/' . $this->gambar);
        }
        return null;
    }

    /**
     * Get the excerpt of the content
     */
    public function getExcerptAttribute()
    {
        return \Illuminate\Support\Str::limit(strip_tags($this->isi), 150);
    }    /**
     * Scope to get only published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get only draft posts
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Get the user that created this berita
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the author name attribute for backward compatibility
     */
    public function getPenulisAttribute()
    {
        return $this->user ? $this->user->name : 'User Tidak Diketahui';
    }
}
