<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'RH',
            'user',
        ];

        foreach ($roles as $role) {
            if (!\Spatie\Permission\Models\Role::where('name', $role)->exists()) {
                \Spatie\Permission\Models\Role::create(['name' => $role]);
            }

            $permissions = \Spatie\Permission\Models\Permission::all();
            foreach ($permissions as $permission) {
                \Spatie\Permission\Models\Role::findByName('admin')->givePermissionTo($permission);
            }
        }

        $permissionsUser = [
            'dashboard.view',
            'login.view',
            'login.do',
            'curriculum.index',
            'curriculum.show',
            'curriculum.create',
            'curriculum.edit',
            'curriculum.delete',
            'users.edit'
        ];

        foreach ($permissionsUser as $permission) {
            if (!\Spatie\Permission\Models\Permission::where('name', $permission)->exists()) {
                \Spatie\Permission\Models\Permission::create(['name' => $permission]);
            }
        }

        $role = \Spatie\Permission\Models\Role::findByName('user');
        foreach ($permissionsUser as $permission) {
            $role->givePermissionTo($permission);
        }

        $permissionsRH = [
            'dashboard.view',
            'login.view',
            'login.do',
            'curriculum.index',
            'curriculum.show',
            'curriculum.create',
            'curriculum.edit',
            'curriculum.delete',
            'users.index',
            'users.show',
            'users.create',
            'users.delete',
        ];
        foreach ($permissionsRH as $permission) {
            \Spatie\Permission\Models\Role::findByName('RH')->givePermissionTo($permission);
        }
    }
}
