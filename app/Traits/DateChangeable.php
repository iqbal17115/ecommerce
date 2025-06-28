<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;

trait DateChangeable
{
    /**
     * Scope to filter records based on a date range.
     *
     * @param Builder $builder
     * @param string $startDate
     * @param string $endDate
     * @return Builder
     * @throws Exception
     */
    public function scopeOfDateChange(Builder $builder, $startDate = '', string $endDate = ''): Builder
    {
        // Replace 'your_table' with your actual table name
        $table = $this->getTable(); // Retrieve the table name associated with the model

        // If the date range property is empty or both start date and end date are empty, return the builder unchanged.
        if (empty($this->dateRange) || (empty($startDate) && empty($endDate))) {
            return $builder;
        }

        // If the start date is empty, assign the end date to the start date.
        if (empty($startDate)) {
            $startDate = $endDate;
        }

        // If the end date is empty, assign the start date to the end date.
        if (empty($endDate)) {
            $endDate = $startDate;
        }

        // Convert start and end dates to full day range for accurate comparison.
        $startDate = Carbon::parse($startDate)->startOfDay();
        $endDate = Carbon::parse($endDate)->endOfDay();

        // Apply the whereBetween clause only if both start date and end date are not empty.
        return $builder->when(!empty($startDate) && !empty($endDate), function ($query) use ($builder, $table, $startDate, $endDate) {
            // Loop through the searchable properties and add a where clause
            foreach ($this->dateRange as $dateRange) {
                // Check if the model has a custom method for the sorting
                if (method_exists($this, $dateRange)) {
                    // Call the custom method to handle the sorting
                    return $this->{$dateRange}($builder, $startDate, $endDate);
                } else {
                    // If there is no custom method, perform a regular whereBetween with table name prefix
                    return $query->whereBetween("$table.$dateRange", [$startDate, $endDate]);
                }
            }
        });
    }
}