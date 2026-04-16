<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    /**
     * Store an optimized WebP image without resizing
     *
     * @param  string  $path  Directory path within public disk
     * @param  int  $quality  Quality level (1-100, default 90)
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
            $filename = Str::uuid().'.webp';
            $storagePath = $path.'/'.$filename;

            // Create directory if it doesn't exist
            $uploadDir = public_path('uploads/'.$path);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Store to public/uploads folder
            $encoded->save(public_path('uploads/'.$storagePath));

            return $storagePath;
        } catch (\Exception $e) {
            Log::error('Image processing failed: '.$e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'path' => $path,
            ]);

            // Fallback: save original file to public/uploads
            $uploadDir = public_path('uploads/'.$path);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            return $path.'/'.$filename;
        }
    }

    /**
     * Delete image from storage
     *
     * @param  string  $path  Path to image
     */
    public function delete(string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        $filePath = public_path('uploads/'.$path);
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    /**
     * Get full URL for an image
     *
     * @param  string  $path  Path to image
     */
    public function url(string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        return asset('uploads/'.$path);
    }
}
