<?php

namespace App\Http\Controllers\Ecommerce\Wishlist;

use App\Http\Controllers\Controller;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $wishlistService;
    
    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }
    public function getWishlistCount(Request $request)
    {
        $userId = $request->user()->id;
        $wishlistCount = $this->wishlistService->getWishlistCount($userId);

        return response()->json(['wishlist_count' => $wishlistCount]);
    }
    public function addToWishlist(Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->input('product_id');
        $wishlistItem = $this->wishlistService->addProductToWishlist($userId, $productId);
        $wishlistCount = $this->wishlistService->getWishlistCount($userId);

        return response()->json([
            'wishlist_item' => $wishlistItem,
            'wishlist_count' => $wishlistCount,
        ]);
    }

    public function removeFromWishlist(Request $request)
    {
        $userId = $request->user()->id;
        $productId = $request->input('product_id');

        $this->wishlistService->removeProductFromWishlist($userId, $productId);
        $wishlistCount = $this->wishlistService->getWishlistCount($userId);

        return response()->json([
            'message' => 'Product removed from wishlist',
            'wishlist_count' => $wishlistCount,
        ]);
    }
}