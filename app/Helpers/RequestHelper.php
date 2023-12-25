<?php

namespace App\Helpers;

class RequestHelper
{
    /**
     * Get Common Rules For Lists
     *
     * @return array[]
     */
    public static function getCommonRulesForRequestLists(): array
    {
        return [
            'page' => ['required', 'integer'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'search' => ['nullable'],
            'sort_by' => ['nullable'],
            'sort_order' => ['nullable']
        ];
    }
}
