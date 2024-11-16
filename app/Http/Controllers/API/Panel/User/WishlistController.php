<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Wishlist\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function count(Request $request)
    {
        $wishlist_count = Wishlist::where("user_id", $request->user_id)->count();
        return Message::success(null, $wishlist_count);
    }
}
