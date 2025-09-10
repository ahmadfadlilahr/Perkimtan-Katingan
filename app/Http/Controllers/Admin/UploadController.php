<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Upload gambar untuk TinyMCE editor
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        Log::info('=== Upload Request Received ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Request files: ', $request->allFiles());
        Log::info('Request all: ', $request->all());

        try {
            // Check for file in different possible parameter names
            $file = null;
            $fileParamNames = ['file', 'blobid0', 'blobid', 'upload'];

            foreach ($fileParamNames as $paramName) {
                if ($request->hasFile($paramName)) {
                    $file = $request->file($paramName);
                    Log::info('File found with parameter name: ' . $paramName);
                    break;
                }
            }

            if (!$file) {
                Log::error('No file found in request');
                return response()->json([
                    'error' => 'No file uploaded'
                ], 400);
            }

            // Validasi file - fix validation array
            if (!$file->isValid()) {
                return response()->json([
                    'error' => 'File tidak valid'
                ], 400);
            }

            // Check file extension
            $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, $allowedExtensions)) {
                return response()->json([
                    'error' => 'File harus berupa: ' . implode(', ', $allowedExtensions)
                ], 400);
            }

            // Check file size (2MB max)
            if ($file->getSize() > 2048 * 1024) {
                return response()->json([
                    'error' => 'File terlalu besar. Maksimal 2MB'
                ], 400);
            }            // Generate nama file yang unik
            $fileName = $this->generateUniqueFileName($file);

            // Path untuk menyimpan file
            $uploadPath = 'uploads/tinymce/' . date('Y/m');

            // Pastikan direktori ada
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath, 0755, true);
            }

            // Resize dan kompres gambar jika perlu
            $processedImage = $this->processImage($file);

            // Simpan file
            $filePath = $uploadPath . '/' . $fileName;
            Storage::disk('public')->put($filePath, $processedImage);

            // Return URL untuk TinyMCE
            $url = asset('storage/' . $filePath);

            Log::info('Upload successful, returning response:');
            Log::info('URL: ' . $url);
            Log::info('Filename: ' . $fileName);

            $response = [
                'location' => $url,
                'filename' => $fileName,
                'size' => Storage::disk('public')->size($filePath)
            ];

            Log::info('Response data: ', $response);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('TinyMCE Upload Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Gagal mengupload gambar. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Generate nama file yang unik
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function generateUniqueFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $baseName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        // Batasi panjang nama file
        $baseName = Str::limit($baseName, 50, '');

        return $baseName . '_' . time() . '_' . Str::random(8) . '.' . $extension;
    }

    /**
     * Proses gambar (resize dan kompres)
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function processImage($file)
    {
        try {
            // Untuk saat ini, gunakan file original
            // Nanti bisa ditambahkan image processing jika diperlukan
            return file_get_contents($file->getRealPath());

        } catch (\Exception $e) {
            // Jika ada error, return file original
            return file_get_contents($file->getRealPath());
        }
    }

    /**
     * Hapus gambar yang tidak terpakai
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $imageUrl = $request->input('url');

            if (!$imageUrl) {
                return response()->json(['error' => 'URL gambar tidak ditemukan'], 400);
            }

            // Extract path dari URL
            $path = str_replace(asset('storage/'), '', $imageUrl);

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);

                return response()->json(['message' => 'Gambar berhasil dihapus']);
            }

            return response()->json(['error' => 'Gambar tidak ditemukan'], 404);

        } catch (\Exception $e) {
            Log::error('TinyMCE Delete Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Gagal menghapus gambar'
            ], 500);
        }
    }
}
