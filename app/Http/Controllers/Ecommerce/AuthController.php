<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password'])
        ]);
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