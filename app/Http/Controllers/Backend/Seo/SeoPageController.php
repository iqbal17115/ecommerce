<?php

namespace App\Http\Controllers\Backend\Seo;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoPage\SeoUpdateRequest;
use App\Http\Requests\SeoPage\StoreSeoPageRequest;
use App\Models\Backend\Seo\SeoPage;
use App\Services\SeoPageService;
use Exception;

class SeoPageController extends Controller
{
    private $seoPageService;

    public function __construct(SeoPageService $seoPageService)
    {
        $this->seoPageService = $seoPageService;
    }

    public function index()
    {
        try {
            $seoPages = $this->seoPageService->getAllSeoPages();
            return view('backend.marketing.digital-marketing.seo-pages.index', compact('seoPages'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching from the SEO Page: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('backend.marketing.digital-marketing.seo-pages.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while i go to seo page create: ' . $e->getMessage());
        }
    }

    public function store(StoreSeoPageRequest $request)
    {
        try {
            $this->seoPageService->createSeoPage($request->validated());
            return redirect()->route('seo-pages.index')->with('success', 'SEO page created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while SEO page create: ' . $e->getMessage());
        }
    }

    public function edit(SeoPage $seoPage)
    {
        try {
            return view('backend.marketing.digital-marketing.seo-pages.edit', compact('seoPage'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while go to seo update page: ' . $e->getMessage());
        }
    }

    public function update(SeoUpdateRequest $request, SeoPage $seoPage)
    {
        try {
            $this->seoPageService->updateSeoPage($seoPage, $request->validated());

            return redirect()->route('seo-pages.index')->with('success', 'SEO page updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while update seo page: ' . $e->getMessage());
        }
    }

    public function destroy(SeoPage $seoPage)
    {
        try {
            $this->seoPageService->deleteSeoPage($seoPage);

            return redirect()->route('seo-pages.index')->with('success', 'SEO page deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while delete seo page: ' . $e->getMessage());
        }
    }
}
