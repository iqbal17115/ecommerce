<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function deleteCustomer(User $user)
    {
        // Delete the customer
        $user->delete();
    }
    public function getAllCustomer($perPage)
    {
        $query = User::orderBy('id', 'desc')->paginate($perPage);

        return $query;
    }
    public function findCustomer($id)
    {
        return User::find($id);
    }

    public function toggleStatus(User $user)
    {
        $user->status = $user->status == 'active' ? 'inactive' : 'active';
        $user->save();
    }
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
                    })
                    ->when(isset($searchTerm['search_key']), function ($query) use ($searchTerm) {
                        $query->orWhere('users.name', 'LIKE', '%' . $searchTerm['search_key'] . '%');
                    })
                    ->when(isset($searchTerm['search_key']), function ($query) use ($searchTerm) {
                        $query->orWhere('users.email', 'LIKE', '%' . $searchTerm['search_key'] . '%');
                    })
                    ->when(isset($searchTerm['search_key']), function ($query) use ($searchTerm) {
                        $query->orWhere('users.mobile', 'LIKE', '%' . $searchTerm['search_key'] . '%');
                    });
            })
            ->select('users.*')
            ->orderBy('users.id', 'desc')
            ->paginate($perPage);

        return $query;
    }
}
