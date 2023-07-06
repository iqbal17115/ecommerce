<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Setting\Division;
use App\Models\User;
use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    public function customerStatus(Request $request, $id)
    {
        $customer = $this->customerService->findCustomer($id);

        if ($customer) {
            $this->customerService->toggleStatus($customer);

            return response()->json(['success' => true, 'message' => 'Customer status updated successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Customer not found.']);
    }
    public function profile(User $user) {
        return view('backend.customer.customer-profile', compact('user'));
    }
    public function search(Request $request)
    {
        $perPage = $request->input('perPage', 50);
        $searchTerm = $request->all();
        $customers = $this->customerService->getCustomers($searchTerm, $perPage);
        return view('backend.customer.partials.customers_table', compact('customers'))->render();
    }
    /**
     * List Page
     *
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function manageCustomer(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        try {
            $perPage = $request->input('perPage', 50);
            $searchTerm = $request->input('searchTerm');

            $customers = $this->customerService->getCustomers($searchTerm, $perPage);

            $divisions = Division::get();
            return view('backend.customer.manage-customer', compact('customers', 'divisions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching the products: ' . $e->getMessage());
        }
    }
}
