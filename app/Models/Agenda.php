<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'tanggal_agenda',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'penyelenggara',
        'gambar',
        'lampiran',
        'kategori',
        'prioritas',
        'status',
        'is_featured',
        'is_publik',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tanggal_agenda' => 'date',
        'is_featured' => 'boolean',
        'is_publik' => 'boolean',
    ];

    /**
     * Status constants
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DIBATALKAN = 'dibatalkan';

    /**
     * Kategori constants
     */
    const KATEGORI_RAPAT = 'rapat';
    const KATEGORI_SOSIALISASI = 'sosialisasi';
    const KATEGORI_WORKSHOP = 'workshop';
    const KATEGORI_ACARA_PUBLIK = 'acara_publik';

    /**
     * Prioritas constants
     */
    const PRIORITAS_RENDAH = 'rendah';
    const PRIORITAS_SEDANG = 'sedang';
    const PRIORITAS_TINGGI = 'tinggi';
    const PRIORITAS_MENDESAK = 'mendesak';

    /**
     * Boot model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agenda) {
            if (empty($agenda->slug)) {
                $agenda->slug = Str::slug($agenda->judul);
            }
            if (Auth::check()) {
                $agenda->created_by = Auth::id();
            }
        });

        static::updating(function ($agenda) {
            if ($agenda->isDirty('judul')) {
                $agenda->slug = Str::slug($agenda->judul);
            }
        });
    }

    /**
     * Get the user that created the agenda.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for published agendas
     */
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    /**
     * Scope for public agendas
     */
    public function scopePublik($query)
    {
        return $query->where('is_publik', true);
    }

    /**
     * Scope for featured agendas
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for upcoming agendas
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_agenda', '>=', now()->toDateString());
    }

    /**
     * Get status options
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
        ];
    }

    /**
     * Get kategori options
     */
    public static function getKategoriOptions(): array
    {
        return [
            self::KATEGORI_RAPAT => 'Rapat',
            self::KATEGORI_SOSIALISASI => 'Sosialisasi',
            self::KATEGORI_WORKSHOP => 'Workshop',
            self::KATEGORI_ACARA_PUBLIK => 'Acara Publik',
        ];
    }

    /**
     * Get prioritas options
     */
    public static function getPrioritasOptions(): array
    {
        return [
            self::PRIORITAS_RENDAH => 'Rendah',
            self::PRIORITAS_SEDANG => 'Sedang',
            self::PRIORITAS_TINGGI => 'Tinggi',
            self::PRIORITAS_MENDESAK => 'Mendesak',
        ];
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'gray',
            self::STATUS_PUBLISHED => 'green',
            self::STATUS_SELESAI => 'blue',
            self::STATUS_DIBATALKAN => 'red',
            default => 'gray',
        };
    }

    /**
     * Get prioritas badge color
     */
    public function getPrioritasBadgeColorAttribute(): string
    {
        return match($this->prioritas) {
            self::PRIORITAS_RENDAH => 'gray',
            self::PRIORITAS_SEDANG => 'yellow',
            self::PRIORITAS_TINGGI => 'orange',
            self::PRIORITAS_MENDESAK => 'red',
            default => 'gray',
        };
    }

    /**
     * Get formatted agenda date
     */
    public function getTanggalAgendaFormattedAttribute(): string
    {
        return $this->tanggal_agenda?->format('d F Y') ?? '-';
    }

    /**
     * Get formatted time range
     */
    public function getWaktuAgendaFormattedAttribute(): string
    {
        if (!$this->waktu_mulai && !$this->waktu_selesai) {
            return '-';
        }

        $start = $this->waktu_mulai ? substr($this->waktu_mulai, 0, 5) : '';
        $end = $this->waktu_selesai ? substr($this->waktu_selesai, 0, 5) : '';

        if ($start && $end) {
            return "{$start} - {$end}";
        }

        return $start ?: $end;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusOptions()[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get kategori label
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::getKategoriOptions()[$this->kategori] ?? ucfirst($this->kategori);
    }

    /**
     * Get prioritas label
     */
    public function getPrioritasLabelAttribute(): string
    {
        return self::getPrioritasOptions()[$this->prioritas] ?? ucfirst($this->prioritas);
    }

    /**
     * Get user relationship (alias for creator)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
