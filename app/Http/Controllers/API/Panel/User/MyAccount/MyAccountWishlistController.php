<?php

namespace App\Http\Controllers\API\Panel\User\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\MyAccount\Wishlist\MyAccountWishlistResource;
use App\Models\Frontend\Wishlist\Wishlist;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\Request;

class MyAccountWishlistController extends Controller
{
    use BaseModel;

    public function list(Request $request)
    {
        $wishlist = $this->getLists(Wishlist::where("user_id", $request->user_id), $request->all(), MyAccountWishlistResource::class);
        return Message::success(null, $wishlist);
    }

    public function removeWishlist(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
