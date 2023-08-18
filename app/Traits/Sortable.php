<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @throws Exception
     */
    public function scopeOfOrderBy(Builder $builder, $sortBy = null, string $sortOrder = null): Builder
    {
        //Get Sort By Form Sortable
        $sortBy = $this->sortable[$sortBy] ?? null;

        //if sort by not empty
        if (!empty($sortBy)) {
            // Check if the model has a custom method for the sorting
            if (method_exists($this, $sortBy)) {
                // Call the custom method to handle the sorting
                $this->{$sortBy}($builder, $sortOrder);
            } else {
                // If there is no custom method, perform a regular orderBy
                $builder->orderBy($sortBy, $sortOrder);
            }
        }

        // Default sorting by "id" in ascending order
        return $builder->orderBy("id", "asc");
    }
}
