<?php
namespace App\Services;

use App\Models\Frontend\Wishlist\Wishlist;

class WishlistService
{
    public function addProductToWishlist($userId, $productId)
    {
        // Check if the product already exists in the user's wishlist
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if (!$wishlistItem) {
            // Add the product to the user's wishlist
            $wishlistItem = Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
        }

        return $wishlistItem;
    }

    public function removeProductFromWishlist($userId, $productId)
    {
        // Find and delete the product from the user's wishlist
        Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();
    }

    public function getWishlistCount($userId)
    {
        return Wishlist::where('user_id', $userId)->count();
    }
}