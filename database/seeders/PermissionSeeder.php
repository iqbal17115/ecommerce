<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = config("contents.permissions");

        // Permission Create
        foreach ($permissions as $permission) {
            $route = is_array($permission['route']) ? json_encode($permission['route']) : $permission['route'];

            Permission::updateOrCreate(
                [
                    'route' => $route
                ],
                [
                    'name' => $permission['name'],
                    'route' => $route,
                    'type' => $permission['type'],
                    'feature' => $permission['feature'],
                    'is_permanent' => true
                ]
            );
        }
    }
}
