<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait Barcode
{
    private function generateBarcodeImageFromString($content)
    {
        // Generate an image using GD
        $image = imagecreatetruecolor(300, 100);

        // Generate a unique color based on the content hash
        $hashColor = substr(md5($content), 0, 6); // Use the first 6 characters of the hash
        $barcodeColor = imagecolorallocate($image, hexdec(substr($hashColor, 0, 2)), hexdec(substr($hashColor, 2, 2)), hexdec(substr($hashColor, 4, 2)));

        // Fill the background with a light color
        $bgColor = imagecolorallocate($image, 240, 240, 240);
        imagefill($image, 0, 0, $bgColor);

        // Create a pattern with dark and light stripes
        $stripeColor1 = imagecolorallocate($image, 200, 200, 200);
        $stripeColor2 = imagecolorallocate($image, 230, 230, 230);
        for ($x = 0; $x < 300; $x += 10) {
            imagefilledrectangle($image, $x, 0, $x + 5, 100, $stripeColor1);
            imagefilledrectangle($image, $x + 5, 0, $x + 10, 100, $stripeColor2);
        }

        // Draw barcode-like lines
        for ($i = 0; $i < strlen($content); $i++) {
            imageline($image, $i * 30, 0, $i * 30, 100, $barcodeColor);
        }

        ob_start();
        imagepng($image);
        $barcodeImage = ob_get_clean();

        imagedestroy($image);

        return $barcodeImage;
    }
}
