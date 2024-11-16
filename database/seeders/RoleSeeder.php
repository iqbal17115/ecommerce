<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //global roles
        $globalRoles = config("contents.global_roles");

        //feature roles
        $featureRoles = config("contents.feature_roles");

        //merge roles
        $roles = array_merge($globalRoles, $featureRoles);

        //role Create
        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'details' => $role['details'],
                'is_permanent' => $role['is_permanent'],
                'is_admin' => $role['is_admin'],
                'is_registered' => $role['is_registered'],
                'type' => $role['type']
            ]);
        }
    }
}
