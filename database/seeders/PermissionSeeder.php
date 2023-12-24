<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        // permission
        $permission = [
            'view_profile', 'create_user', 'delete_user', 'edit_user',
            'view_department', 'create_department', 'delete_department', 'edit_department',
            'view_role', 'create_role', 'delete_role', 'edit_role',
            'view_permission', 'create_permission', 'delete_permission', 'edit_permission',
            'view_companyData', 'create_companyData', 'delete_companyData', 'edit_companyData',
        ];
        foreach ($permission as $p) {
            \Spatie\Permission\Models\Permission::create([
                'name' => $p,
            ]);
        }
    }
}
