<?php

namespace App\Services;

use App\Models\Agenda;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaService
{
    /**
     * Get paginated agendas with filters
     */
    public function getPaginatedAgendas(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Agenda::with('creator')
            ->latest('tanggal_agenda')
            ->latest('id');

        // Apply filters
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['kategori'])) {
            $query->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['prioritas'])) {
            $query->where('prioritas', $filters['prioritas']);
        }

        if (isset($filters['is_featured'])) {
            $query->where('is_featured', $filters['is_featured']);
        }

        if (isset($filters['is_publik'])) {
            $query->where('is_publik', $filters['is_publik']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('tanggal_agenda', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('tanggal_agenda', '<=', $filters['date_to']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get agenda by slug
     */
    public function getBySlug(string $slug): ?Agenda
    {
        return Agenda::where('slug', $slug)->first();
    }

    /**
     * Create new agenda
     */
    public function createAgenda(array $data): Agenda
    {
        // Handle file uploads
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            $data['gambar'] = $this->uploadFile($data['gambar'], 'agenda/images');
        }

        if (isset($data['lampiran']) && $data['lampiran'] instanceof UploadedFile) {
            $data['lampiran'] = $this->uploadFile($data['lampiran'], 'agenda/attachments');
        }

        // Ensure slug is unique
        $data['slug'] = $this->generateUniqueSlug($data['judul']);

        return Agenda::create($data);
    }

    /**
     * Update existing agenda
     */
    public function updateAgenda(Agenda $agenda, array $data): Agenda
    {
        // Handle file uploads
        if (isset($data['gambar']) && $data['gambar'] instanceof UploadedFile) {
            // Delete old image
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $data['gambar'] = $this->uploadFile($data['gambar'], 'agenda/images');
        }

        if (isset($data['lampiran']) && $data['lampiran'] instanceof UploadedFile) {
            // Delete old attachment
            if ($agenda->lampiran) {
                Storage::disk('public')->delete($agenda->lampiran);
            }
            $data['lampiran'] = $this->uploadFile($data['lampiran'], 'agenda/attachments');
        }

        // Update slug if title changed
        if (isset($data['judul']) && $data['judul'] !== $agenda->judul) {
            $data['slug'] = $this->generateUniqueSlug($data['judul'], $agenda->id);
        }

        $agenda->update($data);
        return $agenda->fresh();
    }

    /**
     * Delete agenda
     */
    public function deleteAgenda(Agenda $agenda): bool
    {
        // Delete associated files
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        if ($agenda->lampiran) {
            Storage::disk('public')->delete($agenda->lampiran);
        }

        return $agenda->delete();
    }

    /**
     * Get agenda statistics
     */
    public function getStatistics(): array
    {
        $total = Agenda::count();
        $published = Agenda::where('status', Agenda::STATUS_PUBLISHED)->count();
        $upcoming = Agenda::upcoming()->count();
        $featured = Agenda::where('is_featured', true)->count();

        return [
            'total' => $total,
            'published' => $published,
            'draft' => $total - $published,
            'upcoming' => $upcoming,
            'featured' => $featured,
        ];
    }

        /**
     * Get all agendas with pagination and filters (for admin)
     */
    public function getAllAgendas(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = Agenda::with('user')->orderBy('tanggal_agenda', 'desc');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('judul', 'LIKE', '%' . $filters['search'] . '%')
                  ->orWhere('konten', 'LIKE', '%' . $filters['search'] . '%')
                  ->orWhere('lokasi', 'LIKE', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['category'])) {
            $query->where('kategori', $filters['category']);
        }

        if (isset($filters['is_publik'])) {
            $query->where('is_publik', $filters['is_publik']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('tanggal_agenda', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('tanggal_agenda', '<=', $filters['date_to']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get public agendas with pagination and filters
     * Note: Shows ALL published agendas regardless of is_publik flag
     * The is_publik field is used only for display purposes (badge)
     */
    public function getPublicAgendas(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Agenda::published()
            ->with('creator')
            ->latest('tanggal_agenda')
            ->latest('id');

        // Apply frontend filters
        if (!empty($filters['kategori'])) {
            $query->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['exclude_id'])) {
            $query->where('id', '!=', $filters['exclude_id']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get featured agendas
     * Note: Shows ALL published featured agendas regardless of is_publik flag
     * The is_publik field is used only for display purposes (badge)
     */
    public function getFeaturedAgendas(int $limit = 5)
    {
        return Agenda::published()
            ->featured()
            ->upcoming()
            ->with('creator')
            ->latest('tanggal_agenda')
            ->limit($limit)
            ->get();
    }

    /**
     * Upload file helper
     */
    private function uploadFile(UploadedFile $file, string $directory): string
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($directory, $filename, 'public');
    }

    /**
     * Generate unique slug
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = Agenda::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
