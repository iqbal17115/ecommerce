<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create(array $input)
    {
        dd("OK");
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();


        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'address' => $input['address'],
                'mobile' => $input['mobile'],
                'type' => 'Customer',
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $this->createTeam($user);
                $user->assignRole('customer');
                $contact = Contact::whereMobile($user->mobile)->firstOrNew();
                $contact->business_name = $input['business_name'];
                $contact->first_name = $user->name;
                $contact->address = $user->address;
                $contact->shipping_address = $user->address;
                $contact->user_id = $user->id;
                $contact->type = 'Customer';
                $contact->mobile = $user->mobile;
                $contact->created_by = $user->id;
                $contact->save();
            });
        });
    
    }   
}
