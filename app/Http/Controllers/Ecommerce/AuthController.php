<?php

namespace App\Http\Controllers\Ecommerce;

use App\Events\UserRegistered;
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
                    // return redirect()->route('dashboard');
                    // dd(redirect()->intended(route('home')));
                    return redirect()->intended(route('home'));
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
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:70',
                'mobile_or_email' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^(?:\+88)?01[3-9]\d{8}$/', $value)) {
                            $fail('The input must be a valid email address or Bangladeshi mobile number.');
                        }

                        if (User::where('email', $value)->orWhere('mobile', $value)->exists()) {
                            $fail('This email or mobile number is already registered.');
                        }
                    }
                ],
                'password' => ['required', 'min:6'],
            ]);

            $isEmail = filter_var($validatedData['mobile_or_email'], FILTER_VALIDATE_EMAIL);
            $isMobile = preg_match('/^(?:\+88)?01[3-9]\d{8}$/', $validatedData['mobile_or_email']);


            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $isEmail ? $validatedData['mobile_or_email'] : null,
                'mobile' => $isMobile ? $validatedData['mobile_or_email'] : null,
                'password' => bcrypt($validatedData['password']),
            ]);

            $role = Role::where('name', 'User')->first();
            if ($role) {
                $user->roles()->sync($role->id);
            }

            // **Ensure User is Logged in Properly**
            Auth::login($user);
            $request->session()->regenerate(); // 🔥 Important fix

            // **Verify if Authenticated**
            if (!Auth::check()) {
                throw new \Exception('Authentication failed.');
            }

            // **Event**
            event(new UserRegistered($user));

            DB::commit();
            return redirect('/admin')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }
}
