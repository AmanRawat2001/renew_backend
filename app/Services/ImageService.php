<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Format;



class ImageService
{
    /**
     * Store an optimized WebP image without resizing
     *
     * @param UploadedFile $file
     * @param string $path Directory path within public disk
     * @param int $quality Quality level (1-100, default 90)
     * @return string Path to stored image
     */
    public function storeOptimized(
        UploadedFile $file,
        string $path = 'images',
        int $quality = 90
    ): string {
        try {
            $image = Image::decode($file);

            // Encode as WebP with quality optimization (no resizing)
            $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

            // Generate unique filename
            $filename = Str::uuid() . '.webp';
            $storagePath = $path . '/' . $filename;

            // Store to public disk
            Storage::disk('public')->put($storagePath, $encoded);

            return $storagePath;
        } catch (\Exception $e) {
            Log::error('Image processing failed: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'path' => $path,
            ]);

            // Fallback to original storage if processing fails
            return $file->store($path, 'public');
        }
    }

    /**
     * Delete image from storage
     *
     * @param string $path Path to image
     * @return bool
     */
    public function delete(string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }

    /**
     * Get full URL for an image
     *
     * @param string $path Path to image
     * @return string|null
     */
    public function url(string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        return asset('storage/' . $path);
    }
}
