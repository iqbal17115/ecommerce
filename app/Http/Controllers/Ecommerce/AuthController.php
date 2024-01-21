<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\AuthHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('ecommerce.sign-in');
    }
    public function authenticate(LoginRequest $loginRequest)
    {
        try {
            if (Auth::attempt($loginRequest->validated())) {
                // Get the authenticated user.
                $user = AuthHelper::getAuthenticatedUser();
                // Check if the user's email has been verified.
                // AuthHelper::isNotVerifiedUser($user);

                // Create Personal Access Token for logged-in user
                $token = AuthHelper::createPersonalAccessToken($user, 'Personal Access Token');

                return redirect('/my-account');

                // Pass necessary data to the success method
                // return Message::success(__("messages.success_login"), [
                //     'access_token' => $token,
                //     'token_type' => 'bearer',
                //     'user' => LoginResource::make($user)
                // ]);
            }

            return Message::error(__("messages.invalid_username_password"));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
    public function signUpIndex()
    {
        return view('ecommerce.sign-up');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('home'));
    }
    public function create(array $data)
    {
        return tap(User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            // 'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]), function (User $user) use ($data) {
            $role = Role::where("name", 'User')->first();
            $user->roles()->sync($role->id);
            $contact = Contact::whereMobile($user->mobile)->firstOrNew();
            $contact->first_name = $user->name;
            $contact->address = $user->address;
            $contact->shipping_address = $user->address;
            $contact->user_id = $user->id;
            $contact->type = 'Customer';
            $contact->mobile = $user->mobile;
            // $contact->email = $user->email;
            $contact->created_by = $user->id;
            $contact->save();
        });
    }
    public function customRegistration(Request $request)
    {

        $request->validate([
            'name' => 'required|max:70',
            'mobile' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:2'],
        ]);


        $data = $request->all();
        $user = User::where('mobile', $data['mobile'])->first();

        if ($user) {
            return redirect()->back()->with('message', 'Already exist');
        }
        // $data['password'] = $data['password'];
        $check = $this->create($data);
        $role = Role::where("name", 'User')->first();
        $check->roles()->sync($role->id);

        if ($check) {
            $credentials = $request->validate([
                'mobile' => 'required',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/admin');
            }
        }
    }
}
