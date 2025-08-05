<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserProfilePhotoUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\User\UserInfoResource;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * User Info
     *
     * @param User $user
     * @return JsonResponse
     */
    public function userInfo(Request $request): JsonResponse
    {
        try {
            $user = Auth::user() ?? collect();
            // Return success response with the address info
            return Message::success(null, $user ? UserInfoResource::make($user) : null);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Update User
     *
     * @param UserProfilePhotoUpdateRequest $userProfilePhotoUpdateRequest
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserProfilePhotoUpdateRequest $userProfilePhotoUpdateRequest, User $user): JsonResponse
    {

        // try {
             // Retrieve the image file from the request
               // Retrieve the base64-encoded image from the request
               $base64Image = $userProfilePhotoUpdateRequest->input('img_path');

               // Decode the base64 string to get the image data
               $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
   
               // Process and upload the image
               $targetWidth = 800;
               $targetHeight = 600;
   
               $image = Image::make($imageData);
               $image->resize($targetWidth, $targetHeight, function ($constraint) {
                   $constraint->aspectRatio();
               });
   
               $quality = 80;
               $compressedPath = 'profile_photos/' . uniqid() . '.jpg';
               Storage::disk('public')->put($compressedPath, $image->stream());
   
               $user->profile_photo_path = $compressedPath;
        $user->save();


            //Success Response
            return Message::success(__("messages.success_update"));
        // } catch (Exception $e) {
        //     // Handle any exception that occurs during the process
        //     return Message::error($e->getMessage());
        // }
    }
}
