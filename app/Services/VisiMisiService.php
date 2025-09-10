<?php

namespace App\Services;

use App\Models\VisiMisi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VisiMisiService
{
    /**
     * Get all visi misi items by type with caching
     */
    public function getByType(string $type, bool $activeOnly = true): Collection
    {
        $cacheKey = "visi_misi_{$type}_" . ($activeOnly ? 'active' : 'all');

        return Cache::remember($cacheKey, 60 * 60, function () use ($type, $activeOnly) {
            $query = VisiMisi::byType($type)->ordered();

            if ($activeOnly) {
                $query->active();
            }

            return $query->get();
        });
    }

    /**
     * Get all visi misi items regardless of type
     */
    public function getAll(bool $activeOnly = true): Collection
    {
        $cacheKey = 'visi_misi_all_' . ($activeOnly ? 'active' : 'all');

        return Cache::remember($cacheKey, 60 * 60, function () use ($activeOnly) {
            $query = VisiMisi::ordered();

            if ($activeOnly) {
                $query->active();
            }

            return $query->get();
        });
    }

    /**
     * Get all types with their items
     */
    public function getAllGroupedByType(bool $activeOnly = true): array
    {
        $cacheKey = 'visi_misi_all_grouped_' . ($activeOnly ? 'active' : 'all');

        return Cache::remember($cacheKey, 60 * 60, function () use ($activeOnly) {
            $result = [];
            $types = VisiMisi::getTypes();

            foreach ($types as $typeKey => $typeName) {
                $result[$typeKey] = [
                    'name' => $typeName,
                    'items' => $this->getByType($typeKey, $activeOnly)
                ];
            }

            return $result;
        });
    }

    /**
     * Get only visi and misi data for public pages (optimized)
     */
    public function getPublicVisiMisi(): array
    {
        $cacheKey = 'visi_misi_public_only';

        return Cache::remember($cacheKey, 60 * 60, function () {
            return [
                VisiMisi::TYPE_VISI => [
                    'name' => 'Visi',
                    'items' => $this->getByType(VisiMisi::TYPE_VISI, true)
                ],
                VisiMisi::TYPE_MISI => [
                    'name' => 'Misi',
                    'items' => $this->getByType(VisiMisi::TYPE_MISI, true)
                ]
            ];
        });
    }

    /**
     * Create a new visi misi item
     */
    public function create(array $data): VisiMisi
    {
        DB::beginTransaction();

        try {
            // Set order position if not provided
            if (!isset($data['order_position'])) {
                $data['order_position'] = VisiMisi::byType($data['type'])->max('order_position') + 1;
            }

            $visiMisi = VisiMisi::create($data);

            $this->clearCache();

            DB::commit();

            return $visiMisi;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update a visi misi item
     */
    public function update(VisiMisi $visiMisi, array $data): VisiMisi
    {
        DB::beginTransaction();

        try {
            $visiMisi->update($data);

            $this->clearCache();

            DB::commit();

            return $visiMisi;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a visi misi item
     */
    public function delete(VisiMisi $visiMisi): bool
    {
        DB::beginTransaction();

        try {
            $result = $visiMisi->delete();

            $this->clearCache();

            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Reorder items within a type
     */
    public function reorder(string $type, array $itemIds): bool
    {
        DB::beginTransaction();

        try {
            foreach ($itemIds as $position => $id) {
                VisiMisi::where('id', $id)
                    ->where('type', $type)
                    ->update(['order_position' => $position + 1]);
            }

            $this->clearCache();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Toggle active status
     */
    public function toggleActive(VisiMisi $visiMisi): VisiMisi
    {
        $visiMisi->update(['is_active' => !$visiMisi->is_active]);
        $this->clearCache();

        return $visiMisi;
    }

    /**
     * Clear all related cache
     */
    public function clearCache(): void
    {
        $types = array_keys(VisiMisi::getTypes());

        foreach ($types as $type) {
            Cache::forget("visi_misi_{$type}_active");
            Cache::forget("visi_misi_{$type}_all");
        }

        Cache::forget('visi_misi_all_grouped_active');
        Cache::forget('visi_misi_all_grouped_all');
        Cache::forget('visi_misi_public_only'); // Clear new public-only cache
    }

    /**
     * Get predefined color classes for different types
     */
    public static function getColorClasses(): array
    {
        return [
            'blue' => 'from-blue-50 to-indigo-50 border-blue-100 text-blue-900',
            'green' => 'from-green-50 to-emerald-50 border-green-100 text-green-900',
            'purple' => 'from-purple-50 to-pink-50 border-purple-100 text-purple-900',
            'yellow' => 'from-yellow-50 to-orange-50 border-yellow-100 text-yellow-900',
            'red' => 'from-red-50 to-pink-50 border-red-100 text-red-900',
            'indigo' => 'from-indigo-50 to-blue-50 border-indigo-100 text-indigo-900'
        ];
    }

    /**
     * Get predefined icon classes
     */
    public static function getIconClasses(): array
    {
        return [
            'eye' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
            'target' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            'heart' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            'lightning' => 'M13 10V3L4 14h7v7l9-11h-7z',
            'users' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            'shield' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
        ];
    }
}
