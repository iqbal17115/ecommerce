<?php

namespace App\Traits;

use App\Helpers\Message;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    /**
     * @throws Exception
     */
    public function scopeOfSearch(Builder $builder, $term = null): Builder
    {
        if (!empty($this->searchable) && !empty($term)) {
            // Wrap the searchable conditions in a closure to apply 'and' condition
            $builder->where(function ($query) use ($term) {
                // Loop through the searchable properties and add a where clause
                foreach ($this->searchable as $searchable) {
                    //get parent table name
                    $table = $query->getModel()->getTable();

                    if (str_contains($searchable, '.')) {
                        // If the property is a relation, extract the relation and column
                        $relation = Str::beforeLast($searchable, '.');
                        $column = Str::afterLast($searchable, '.');

                        $query->orWhereRelation($relation, $column, 'like', "%$term%");
                        continue;
                    }
                    $query->orWhere("$table.$searchable", 'like', "%$term%");
                }
            });
        }

        return $builder;
    }
}
