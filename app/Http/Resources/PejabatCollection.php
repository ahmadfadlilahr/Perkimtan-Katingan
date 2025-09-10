<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PejabatCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function ($pejabat) {
                return new PejabatResource($pejabat);
            }),
            'success' => true,
            'message' => 'Data pejabat berhasil diambil',
            'meta' => [
                'total' => $this->total(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
            ],
        ];
    }
}
