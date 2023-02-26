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
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'mobile' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
                return redirect(route('checkout'));
        }

        return back()->withErrors([
            'mobile' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
    }
    public function create(array $data)
    {
        return tap(User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password'])
        ]), function (User $user) use ($data) {
            $user->assignRole('customer');
            $contact = Contact::whereMobile($user->mobile)->firstOrNew();
            $contact->first_name = $user->name;
            $contact->address = $user->address;
            $contact->shipping_address = $user->address;
            $contact->user_id = $user->id;
            $contact->type = 'Customer';
            $contact->mobile = $user->mobile;
            $contact->created_by = $user->id;
            $contact->save();
        });
    }
    public function customRegistration(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:20',
                'mobile' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'min:2'],
            ],
            [
                'name' => 'Name is required',
            ]
        );

        $data = $request->all();
        $check = $this->create($data);
        $check->assignRole('customer');
        if ($check) {
            $credentials = $request->validate([
                'mobile' => ['required'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                // if (Auth::user()->hasAnyRole('admin|user')) {
                //     return redirect('/admin');
                // } else {
                //     return redirect(route('home'));
                // }
            }
        }
    }
}