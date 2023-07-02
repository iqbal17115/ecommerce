<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function getCustomers($searchTerm, $perPage)
    {
        $query = User::query()
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->when(isset($searchTerm['division_id']), function ($query) use ($searchTerm) {
                $query->where('contacts.division_id', $searchTerm['division_id']);
            })
            ->when(isset($searchTerm['district_id']), function ($query) use ($searchTerm) {
                $query->where('contacts.district_id', $searchTerm['district_id']);
            })
            ->when(isset($searchTerm['upazila_id']), function ($query) use ($searchTerm) {
                $query->where('contacts.upazilla_id', $searchTerm['upazila_id']);
            })
            ->when(isset($searchTerm['union_id']), function ($query) use ($searchTerm) {
                $query->where('contacts.union_id', $searchTerm['union_id']);
            })
            ->where(function ($query) use ($searchTerm) {
                $query->when(isset($searchTerm['inactive']) && $searchTerm['inactive'], function ($query) {
                    $query->orWhere('users.status', 'inactive');
                })
                    ->when(isset($searchTerm['active']) && $searchTerm['active'], function ($query) {
                        $query->orWhere('users.status', 'active');
                    })
                    ->when(isset($searchTerm['incomplete']) && $searchTerm['incomplete'], function ($query) {
                        $query->orWhere('users.status', 'incomplete');
                    });
            })
            ->select('users.*')
            ->orderBy('users.id', 'desc')
            ->paginate($perPage);

        return $query;

    }
}