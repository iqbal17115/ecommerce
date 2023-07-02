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
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($query) use ($searchTerm) {
                    $query->where('users.name', 'LIKE', "%$searchTerm%")
                        ->orWhere('users.mobile', 'LIKE', "%$searchTerm%")
                        ->orWhere('users.email', 'LIKE', "%$searchTerm%")
                        ->orWhere('contacts.division', 'LIKE', "%$searchTerm%");
                });
            })
            // ->when($status, function ($query, $status) {
            //     return $query->where('users.status', $status);
            // })
            ->orderBy('users.id', 'desc')
            ->paginate($perPage);

        return $query;
    }
}
