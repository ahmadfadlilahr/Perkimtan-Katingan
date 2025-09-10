<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GaleriCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => GaleriResource::collection($this->collection),
            'success' => true,
            'message' => 'Data galeri berhasil diambil',
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'total' => $this->collection->total(),
                'per_page' => $this->collection->perPage(),
                'current_page' => $this->collection->currentPage(),
                'last_page' => $this->collection->lastPage(),
            ],
        ];
    }
}
