<?php
namespace App\Services;

use App\Models\Backend\Seo\SeoPage;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class SeoPageService
{
    public function getAllSeoPages()
    {
        return SeoPage::orderBy('id', 'DESC')->paginate(10);
    }

    public function createSeoPage(array $data)
    {
        try {
            // Check if the image field exists in the data
            if (array_key_exists('image', $data) && $data['image'] instanceof UploadedFile) {

                // Store the uploaded image
                $imagePath = $data['image']->store('seo-page-images', 'public');

                // Add the image path to the data
                $data['image'] = $imagePath;
            }


            // Create the SEO page

            return SeoPage::create($data);
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            throw new Exception('Failed to add Seo Page', 500);
        }
    }

    public function updateSeoPage(SeoPage $seoPage, array $data)
    {
        // Check if the image field exists in the data
        if (array_key_exists('image', $data) && $data['image'] instanceof UploadedFile) {
            // Delete the existing image (if any)
            if ($seoPage->image) {
                Storage::disk('public')->delete($seoPage->image);
            }
            // Store the uploaded image
            $imagePath = $data['image']->store('seo-page-images', 'public');

            // Update the image field in the data
            $data['image'] = $imagePath;
        } else {
            // Remove the image field from the data
            unset($data['image']);
        }

        // Update the SEO page with the provided data
        $seoPage->update($data);
    }

    public function deleteSeoPage(SeoPage $seoPage)
    {
        $seoPage->delete();
    }
}
