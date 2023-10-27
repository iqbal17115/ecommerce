<?php

namespace App\Http\Controllers\API\Panel\Admin\Product;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Models\Backend\ProductInfo\ProductImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductImage Delete
     *
     * @param ProductImage $productImage
     * @return JsonResponse
     */
    public function destroy(ProductImage $productImage): JsonResponse
    {
        try {
            // Call the function delete address
            $productImage->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
