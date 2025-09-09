<?php
namespace App\Services;

use App\Models\Address\District;
use Illuminate\Database\Eloquent\Builder;
use Mockery\Undefined;

class DistrictService
{
   /**
     * Get districts by division_id if provided, otherwise all districts
     */
    public function getDistricts($divisionId = null): Builder
    {
        $query = District::query()->orderBy('name', 'asc');

        if ($divisionId != Undefined::class) {
            // $query->where('division_id', $divisionId);
        }

        return $query;
    }
}
