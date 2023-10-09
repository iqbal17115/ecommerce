<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $users = config("contents.users");

        //role Create
        foreach ($users as $user) {
            $userData = User::create(
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'mobile' => $user['phone'],
                    'password' => bcrypt($user['password'])
                ]
            );

            $roleIds = Role::whereIn("name", $user['roles'])->get()->pluck("id");
            $userData->roles()->sync($roleIds);
        }
    }
}
