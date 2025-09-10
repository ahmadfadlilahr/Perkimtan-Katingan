<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'description',
        'icon',
        'color_class',
        'order_position',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_position' => 'integer'
    ];

    // Constants for types
    const TYPE_VISI = 'visi';
    const TYPE_MISI = 'misi';

    public static function getTypes(): array
    {
        return [
            self::TYPE_VISI => 'Visi',
            self::TYPE_MISI => 'Misi'
        ];
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_position')->orderBy('id');
    }

    // Accessors
    public function getTypeNameAttribute(): string
    {
        return self::getTypes()[$this->type] ?? ucfirst($this->type);
    }
}
