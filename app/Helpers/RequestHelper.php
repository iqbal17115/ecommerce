<?php

namespace App\Helpers;

class RequestHelper
{
    /**
     * Get Select Rules For Lists
     *
     * @return array[]
     */
    public static function getSelectRulesForRequestLists(): array
    {
        return [
            'is_new' => ['nullable'], //will remove later
            'search' => ['nullable'],
            'page' => ['nullable'],
            'limit' => ['nullable'],
            'sort_by' => ['nullable'],
            'sort_order' => ['nullable'],
            'type' => ['nullable'],
            'account_head' => ['nullable'],
            'account_category' => ['nullable']
        ];
    }

    /**
     * Get Common Rules For Lists
     *
     * @return array[]
     */
    public static function getCommonRulesForRequestLists(): array
    {
        return [
            'page' => ['nullable', 'integer'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'search' => ['nullable'],
            'filters' => ['nullable'],
            'sort_by' => ['nullable'],
            'sort_order' => ['nullable']
        ];
    }

    /**
     * Get Common Rules For Report Request Rules
     *
     * @return array[]
     */
    public static function getCommonRulesForExportRequestLists(): array
    {
        return [
            'page' => ['nullable', 'integer'],
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'search' => ['nullable'],
            'filters' => ['nullable'],
            'sort_by' => ['nullable'],
            'sort_order' => ['nullable'],
            'export_pattern' => ['required', 'in:excel,pdf,print']
        ];
    }
}
