<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait Filterable
{
    /**
     * Apply the filters to the query.
     *
     * @param Builder $builder
     * @param array $filters
     * @return Builder
     */
    public function scopeOfFilter(Builder $builder, array $filters): Builder
    {
        foreach ($filters as $key => $value) {
            //If Key and Value not empty
            if (!empty($key) && !empty($value)) {

                //Get Filterable Method from filterable
                $method = $this->filterable[$key] ?? null;

                // Check if the model has a custom method for the sorting
                if (method_exists($this, $method)) {
                    // Call the custom method to handle the filter
                    $this->{$method}($builder, $value);
                } else {
                    // Check if the column exists in the table
                    if (Schema::hasColumn($builder->getModel()->getTable(), $key)) {
                        // If the column exists, use whereIn to filter by multiple values
                        $builder->whereIn($key, explode(",", $value));
                    }
                }
            }
        }

        return $builder;
    }
}
