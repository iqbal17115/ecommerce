<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\ContactInfo\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('ecommerce.sign-in');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);
        $identifier = $credentials['identifier'];
        $credentials['email'] = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? $credentials['identifier'] : null;
        $credentials['mobile'] = !$credentials['email'] ? $credentials['identifier'] : null;
        unset($credentials['identifier']);
        $credentials = array_filter($credentials);

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $identifier)->first();
        } else {
            $user = User::where('mobile', $identifier)->first();
        }

        if ($user && Auth::attempt($credentials)) {
            $request->session()->regenerate();
                return redirect('/admin');
        }

        return back()->withErrors([
            'mobile' => 'The provided credentials do not match our records.',
        ]);
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
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]), function (User $user) use ($data) {
            $user->roles()->sync($roleIds);
            $contact = Contact::whereMobile($user->mobile)->firstOrNew();
            $contact->first_name = $user->name;
            $contact->address = $user->address;
            $contact->shipping_address = $user->address;
            $contact->user_id = $user->id;
            $contact->type = 'Customer';
            $contact->mobile = $user->mobile;
            $contact->email = $user->email;
            $contact->created_by = $user->id;
            $contact->save();
        });
    }
    public function customRegistration(Request $request)
    {

        $request->validate([
            'name' => 'required|max:20',
            'identifier' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:2'],
        ], [
                'name.required' => 'Name is required',
            ]);

        $data = $request->all();
        $data['email'] = filter_var($data['identifier'], FILTER_VALIDATE_EMAIL) ? $data['identifier'] : null;
        $data['mobile'] = !$data['email'] ? $data['identifier'] : null;
        // Validate email and mobile
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $data['email'])->first();
        } else {
            $user = User::where('mobile', $data['mobile'])->first();
        }

        if($user) {
            return redirect()->back()->with('message', 'Already exist');
        }
        // $data['password'] = $data['password'];
        $check = $this->create($data);
        $check->roles()->sync($roleIds);

        if ($check) {
            $credentials = $request->validate([
                'identifier' => 'required',
                'password' => 'required',
            ]);

            $field = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            if (Auth::attempt([$field => $credentials['identifier'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                if (Auth::user()->hasAnyRole('admin|user')) {
                    return redirect('/admin');
                } else {
                    return redirect(route('home'));
                }
            }
        }
    }
}
