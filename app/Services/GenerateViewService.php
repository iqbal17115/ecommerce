<?php

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class GenerateViewService
{
    private string $viewPath = "";
    private string $breadCrumbTitle = "";
    private string $mainRoute = "";
    private array $tableHeaders = [];
    private array $collections = [];

    private mixed $model = [];
    private bool $isFilterExists = false;

    /**
     * Creates an instance of property via a static method.
     *
     */
    public static function factory(): GenerateViewService
    {
        return new GenerateViewService();
    }

    /**
     * Set View Path
     *
     * @param string $path
     * @return $this
     */
    public function setViewPath(string $path): self
    {
        $this->viewPath = $path;
        return $this;
    }

    /**
     * Set Main Route
     *
     * @param string $name
     * @return $this
     */
    public function setMainRoute(string $name): self
    {
        $this->mainRoute = $name;
        return $this;
    }

    /**
     * Set Table Headers
     *
     * @param array $headers
     * @return $this
     */
    public function setTableHeaders(array $headers): self
    {
        $this->tableHeaders = $headers;
        return $this;
    }

    /**
     * Set Collections
     *
     * @param array $lists
     * @return $this
     */
    public function setCollections(array $lists): self
    {
        $this->collections = $lists;
        return $this;
    }

    /**
     * Set Modal
     *
     * @param $model
     * @return $this
     */
    public function setModel($model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Set Is Filter Exists
     *
     * @param $status
     * @return $this
     */
    public function setIsFilterExists($status): self
    {
        $this->isFilterExists = $status;
        return $this;
    }

    /**
     * Get View Path
     *
     * @return string
     */
    public function getViewPath(): string
    {
        return $this->viewPath;
    }

    /**
     * Get Main Route
     *
     * @return string
     */
    public function getMainRoute(): string
    {
        return $this->mainRoute;
    }

    /**
     * Get Table Headers
     *
     * @return array
     */
    public function getTableHeaders(): array
    {
        return $this->tableHeaders;
    }

    /**
     * Get Collections
     *
     * @return array
     */
    public function getCollections(): array
    {
        return $this->collections;
    }

    /**
     * Get Modal
     *
     * @return mixed
     */
    public function getModel(): mixed
    {
        return $this->model;
    }

    /**
     * Get Is Filter Exists
     *
     * @return bool
     */
    public function getIsFilterExists(): bool
    {
        return $this->isFilterExists;
    }

    /**
     * Generate
     *
     * @return \Illuminate\Contracts\View\View|JsonResponse
     * @throws Exception
     */
    public function generate(): \Illuminate\Contracts\View\View|JsonResponse
    {
        $returnArray = [
            "view_path" => $this->getViewPath(),
            "main_route" => $this->getMainRoute(),
            "linkable_route" => Str::camel($this->getMainRoute()),
            "table_headers" => $this->getTableHeaders(),
            "collections" => $this->getCollections(),
            "model" => $this->getModel(),
            "is_filter_exists" => $this->getIsFilterExists()
        ];

        // Render the view with the updated $returnArray
        return View::make("layouts.admin_partials.resource_pane", $returnArray);
    }
}
