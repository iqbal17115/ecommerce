<?php
namespace App\Services;

use App\Models\Backend\Seo\SeoPage;
use Exception;

class SeoPageService
{
    public function getAllSeoPages()
    {
        return SeoPage::paginate(10);
    }

    public function createSeoPage(array $data)
    {
        try {
            return SeoPage::create($data);
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            throw new Exception('Failed to add Seo Page', 500);
        }
    }

    public function updateSeoPage(SeoPage $seoPage, array $data)
    {
        $seoPage->update($data);
    }

    public function deleteSeoPage(SeoPage $seoPage)
    {
        $seoPage->delete();
    }
}
