<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\AuthHelper;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            // Retrieve input from request
            $credentials = $loginRequest->validated();

            // Determine if the input is a mobile number or email
            $isEmail = filter_var($credentials['mobile'], FILTER_VALIDATE_EMAIL);
            $field = $isEmail ? 'email' : 'mobile';

            // Build the login credentials dynamically
            $loginCredentials = [
                $field => $credentials['mobile'],
                'password' => $credentials['password']
            ];

            // Attempt to authenticate
            if (Auth::attempt($loginCredentials, $loginRequest->boolean('remember'))) {
                $user = AuthHelper::getAuthenticatedUser();

                // Redirect admin users to the backend dashboard
                if ($user->roles->where('is_admin', 1)->isNotEmpty()) {
                    return redirect()->route('dashboard');
                }

                // Redirect non-admin users to their intended URL or a default fallback
                return redirect()->route('home');
            }

            return redirect()->back()->withErrors(['error' => __("messages.invalid_username_password")]);
        } catch (Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:70',
            'mobile_or_email' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                // Check if the input is a valid email or mobile number
                if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^\+?[1-9]\d{1,14}$/', $value)) {
                    $fail('The input must be a valid email address or mobile number.');
                }

                // Check for uniqueness in both `email` and `mobile` columns
                $exists = User::where('email', $value)->orWhere('mobile', $value)->exists();
                if ($exists) {
                    $fail('This email or mobile number is already registered.');
                }
            }],
            'password' => ['required', 'min:6'],
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 70 characters.',
            'mobile_or_email.required' => 'This field is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        // Check if the input is an email or a mobile number
        $isEmail = filter_var($validatedData['mobile_or_email'], FILTER_VALIDATE_EMAIL);
        $isMobile = preg_match('/^\+?[1-9]\d{1,14}$/', $validatedData['mobile_or_email']);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $isEmail ? $validatedData['mobile_or_email'] : null,
                'mobile' => $isMobile ? $validatedData['mobile_or_email'] : null,
                'password' => bcrypt($validatedData['password']),
            ]);

            // Assign "User" role
            $role = Role::where('name', 'User')->first();
            $user->roles()->sync($role->id);

            // Automatically log in the user
            Auth::login($user);
            $request->session()->regenerate();
            // Commit the transaction
            DB::commit();
            return redirect('/admin')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollBack();
        }
    }
}
