<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
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
            return view('backend.customer.manage-customer', compact('customers'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching the products: ' . $e->getMessage());
        }
    }
}