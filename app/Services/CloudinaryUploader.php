<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudinaryUploader
{
    /**
     * @throws RequestException
     */
    public function uploadEventImage(UploadedFile $image): string
    {
        $cloudName = config('services.cloudinary.cloud_name');
        $apiKey = config('services.cloudinary.api_key');
        $apiSecret = config('services.cloudinary.api_secret');
        $folder = config('services.cloudinary.event_folder', 'gcems/events');

        if (! $cloudName || ! $apiKey || ! $apiSecret) {
            throw new RuntimeException('Cloudinary credentials are not configured.');
        }

        $timestamp = time();
        $signature = sha1("folder={$folder}&timestamp={$timestamp}{$apiSecret}");

        $response = Http::asMultipart()
            ->attach('file', fopen($image->getRealPath(), 'r'), $image->getClientOriginalName())
            ->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
                'api_key' => $apiKey,
                'folder' => $folder,
                'timestamp' => $timestamp,
                'signature' => $signature,
            ])
            ->throw()
            ->json();

        return $response['secure_url'] ?? throw new RuntimeException('Cloudinary did not return a secure image URL.');
    }
}
