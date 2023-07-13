<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\DB;

trait BaseModel
{
    use UsesUuid;

    /**
     * Get Lists
     *
     * @param array $validatedData
     * @param string $resourceClass
     * @return mixed
     */
    public static function getLists($query, array $validatedData, string $resourceClass): mixed
    {
        // Get all lists
        $lists = $query->list($validatedData)->paginate(20);

        // Set collection
        return $lists->setCollection(collect($resourceClass::collection($lists->items())));
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
