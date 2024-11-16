<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait CreatedUpdatedBy
{
    protected static function bootCreatedUpdatedBy(): void
    {
        // Get the ID of the currently authenticated user, or null if there is none
        $userId = auth()->user()?->id;

        // Set the `created_by` and `updated_by` properties when a new model instance is being created
        static::creating(function ($model) use ($userId) {
            // Set the `created_by` property to the ID of the authenticated user, if the column exists and the property is not already set
            if (Schema::hasColumn($model->getTable(), 'created_by') && empty($model->created_by)) {
                $model->created_by = $userId;
            }

            // Always set the `updated_by` property to the ID of the authenticated user
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                $model->updated_by = $userId;
            }
        });


        // Set the `updated_by` property when an existing model instance is being updated
        static::updating(function ($model) use ($userId) {
            // Always set the `updated_by` property to the ID of the authenticated user
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                $model->updated_by = $userId;
            }
        });
    }
}
