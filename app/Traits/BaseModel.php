<?php

namespace App\Traits;

use App\Services\GenerateViewService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

trait BaseModel
{
    use CreatedUpdatedBy, Searchable, Sortable, Filterable, UsesUuid;

    /**
     * Generate View
     *
     * @param string $viewPath
     * @param mixed $model
     * @param array|null $collections
     * @return View|JsonResponse
     * @throws Exception
     */
    public function generateView(string $viewPath, mixed $model = [], ?array $collections = []): View|JsonResponse
    {
        return GenerateViewService::factory()
            ->setViewPath($viewPath)
            ->setMainRoute($this->mainRoute ?? "")
            ->setIsFilterExists($this->isFilterExists ?? false)
            ->setTableHeaders($this->tableHeaders ?? [])
            ->setCollections($collections)
            ->setModel($model)
            ->generate();
    }

    /**
     * List scope
     *
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeList($query, $request): mixed
    {
        // Apply the search, ordering, and pagination scopes to the query
        return $query
            ->when(isset($request['search']), fn($query) => $query->ofSearch($request['search']))
            ->when(isset($request['filters']), fn($query) => $query->ofFilter($request['filters']))
            ->when(isset($request['start_date']), fn($query) => $query->ofDateChange($request['start_date'], $request['end_date']))
            ->ofOrderBy($request['sort_by'] ?? null, $request['sort_order'] ?? null);
    }

    /**
     * Get Lists
     *
     * @param $query
     * @param array $validatedData
     * @param string $resourceClass
     * @return mixed
     */
    public static function getLists($query, array $validatedData, string $resourceClass): mixed
    {
        // Get all lists
        $lists = $query->list($validatedData)->paginate(8);

        // Set collection
        return $lists->setCollection(collect($resourceClass::collection($lists->items())));
    }

    /**
     * Generate a JSON-encoded response for a data table.
     *
     * @param array $validatedData The validated data received for the data table.
     * @param string $resourceClass The resource class to use for data transformation.
     *
     * @return string|bool  The JSON-encoded response for the data table.
     */
    public function dataTable($query, array $validatedData, string $resourceClass): string|bool
    {

        // Update the validatedData array
        $validatedData['search'] = $validatedData['search']['value'] ?? null;
        $validatedData['sort_by'] = $validatedData['order'][0]['column'] ?? null;
        $validatedData['sort_order'] = $validatedData['order'][0]['dir'] ?? null;

        // Apply the list scope to the query
        $query->list($validatedData);

        // Clone the query to count the records
        $countQuery = clone $query;

        // Get the total record count
        $records = $countQuery->count();

        // Get the paginated data
        $lists = $query->offset($validatedData['start'])->limit($validatedData['length'])->get();

        // Build the JSON data for the response
        $json_data = [
            'draw' => $validatedData['draw'] ?? 0,
            'recordsTotal' => $records,
            'recordsFiltered' => $records,
            'data' => $resourceClass::collection($lists),
        ];

        // Encode the data as JSON and return
        return json_encode($json_data);
    }

    /**
     * Delete multiple models by their IDs, with the option to execute a callback before deletion.
     *
     * @param array $ids
     * @param callable|null $deleteCallback
     * @return void
     * @throws Exception
     */
    public static function deleteModels(array $ids, callable $deleteCallback = null): void
    {
        $chunkSize = 10; // Set the desired chunk size

        // Retrieve the total number of models for the provided IDs
        $totalModels = self::query()->whereIn('id', $ids)->count();

        if ($totalModels == 0) {
            throw new Exception("No models found for the provided IDs.");
        }
        // Calculate the total number of chunks needed
        $totalChunks = ceil($totalModels / $chunkSize);

        // Process the models in chunks
        for ($chunkIndex = 0; $chunkIndex < $totalChunks; $chunkIndex++) {
            // Calculate the offset for the current chunk
            $offset = $chunkIndex * $chunkSize;

            // Retrieve models for the current chunk
            $models = self::query()
                ->whereIn('id', $ids)
                ->offset($offset)
                ->limit($chunkSize)
                ->get();

            // Start a database transaction for each chunk of models
            DB::transaction(function () use ($models, $deleteCallback) {
                foreach ($models as $model) {
                    // Check if the model exists before deleting
                    if (!$model->exists) {
                        throw new Exception("Model with ID {$model->id} has already been deleted.");
                    }

                    // Execute the provided callback function before deleting the model
                    if (is_callable($deleteCallback)) {
                        $deleteCallback($model);
                    }

                    // Delete the model
                    $model->delete();
                }
            });
        }
    }
}
