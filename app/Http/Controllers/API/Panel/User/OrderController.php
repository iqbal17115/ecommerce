<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly SalesManService $salesManService)
    {
    }
    /**
     * Store
     *
     * @param SalesManRequest $request
     * @return JsonResponse
     */
    public function store(SalesManRequest $request): JsonResponse
    {
        try {
            // Validate the request data and store the data
            $user = $this->salesManService->store($request->validated());

            // Return a success message with the stored data
            return Message::success(__("message.save"), SalesManDetailResource::make($user));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SalesManController/store');
        }
    }
}
