<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class UploadImage
{
    public static function uploadImage($base64Image, $path = "uploads"): string
    {

        // Decode the base64 image data
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Generate a unique filename
        $filename = uniqid() . '_' . time() . '.png';

        // Specify the public storage path
        $path = 'public/' . $path . '/' . $filename;

        // Store the image in the public storage directory
        Storage::disk('local')->put($path, $imageData);

        // Return a response, e.g., JSON response with the image URL
        return Storage::url($path);
    }
}
