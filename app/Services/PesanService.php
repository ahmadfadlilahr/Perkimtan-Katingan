<?php

namespace App\Services;

use App\Models\Pesan;
use Illuminate\Pagination\LengthAwarePaginator;

class PesanService
{
    /**
     * Get all pesan with optional search, pagination, and sorting
     *
     * @param string|null $search
     * @param int $perPage
     * @param string $sort
     * @param string $order
     * @return LengthAwarePaginator
     */
    public function getAllPesan(?string $search = null, int $perPage = 10, string $sort = 'created_at', string $order = 'desc'): LengthAwarePaginator
    {
        $query = Pesan::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_pengirim', 'LIKE', "%{$search}%")
                  ->orWhere('email_pengirim', 'LIKE', "%{$search}%")
                  ->orWhere('subjek', 'LIKE', "%{$search}%")
                  ->orWhere('isi_pesan', 'LIKE', "%{$search}%")
                  ->orWhere('tipe_pesan', 'LIKE', "%{$search}%");
            });
        }

        // Apply sorting
        $allowedSortFields = ['id', 'nama_pengirim', 'email_pengirim', 'subjek', 'tipe_pesan', 'status', 'created_at', 'updated_at'];
        if (!in_array($sort, $allowedSortFields)) {
            $sort = 'created_at';
        }

        $allowedOrders = ['asc', 'desc'];
        if (!in_array($order, $allowedOrders)) {
            $order = 'desc';
        }

        return $query->orderBy($sort, $order)->paginate($perPage);
    }

    /**
     * Create a new pesan (from public contact form)
     *
     * @param array $data
     * @return Pesan
     */
    public function createPesan(array $data): Pesan
    {
        // Set default status
        if (!isset($data['status'])) {
            $data['status'] = 'Belum Dibaca';
        }

        return Pesan::create($data);
    }

    /**
     * Update an existing pesan (admin only)
     *
     * @param Pesan $pesan
     * @param array $data
     * @return Pesan
     */
    public function updatePesan(Pesan $pesan, array $data): Pesan
    {
        $pesan->update($data);
        return $pesan->fresh();
    }

    /**
     * Delete a pesan
     *
     * @param Pesan $pesan
     * @return bool
     */
    public function deletePesan(Pesan $pesan): bool
    {
        return $pesan->delete();
    }

    /**
     * Mark pesan as read
     *
     * @param Pesan $pesan
     * @return Pesan
     */
    public function markAsRead(Pesan $pesan): Pesan
    {
        $pesan->update(['status' => 'Sudah Dibaca']);
        return $pesan->fresh();
    }

    /**
     * Mark pesan as replied
     *
     * @param Pesan $pesan
     * @return Pesan
     */
    public function markAsReplied(Pesan $pesan): Pesan
    {
        $pesan->update(['status' => 'Sudah Dibalas']);
        return $pesan->fresh();
    }

    /**
     * Get pesan by status
     *
     * @param string $status
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPesanByStatus(string $status, int $perPage = 10): LengthAwarePaginator
    {
        return Pesan::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get pesan by type
     *
     * @param string $tipe
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPesanByType(string $tipe, int $perPage = 10): LengthAwarePaginator
    {
        return Pesan::where('tipe_pesan', $tipe)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get pesan statistics
     *
     * @return array
     */
    public function getPesanStats(): array
    {
        return [
            'total_pesan' => Pesan::count(),
            'belum_dibaca' => Pesan::where('status', 'Belum Dibaca')->count(),
            'sudah_dibaca' => Pesan::where('status', 'Sudah Dibaca')->count(),
            'sudah_dibalas' => Pesan::where('status', 'Sudah Dibalas')->count(),
        ];
    }
}
