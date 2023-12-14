<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $user_list   = Permission::create(["name" => "users.list"]);
        $user_view   = Permission::create(["name" => "users.view"]);
        $user_create = Permission::create(["name" => "users.create"]);
        $user_update = Permission::create(["name" => "users.update"]);
        $user_delete = Permission::create(["name" => "users.delete"]);

        // Admin Role
        $admin_role = Role::create(["name" => "admin"]);
        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]);

        // User Role
        $user_role = Role::create(["name" => "user"]);
        $user_role->givePermissionTo([
            $user_list
        ]);

        // Admin User
        $admin = User::create([
            "name"     => "Admin",
            "username" => "admin",
            "email"    => "admin@admin.com",
            "password" => bcrypt("password")
        ]);

        $admin->assignRole($admin_role); // assigned role with the role's permissions

        /*
        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete
        ]); // assigning specified permissions
        */


        // User
        $user = User::create([
            "name"     => "User",
            "username" => "user",
            "email"    => "user@user.com",
            "password" => bcrypt("password")
        ]);

        // user role
        $user->assignRole($user_role);

        /*
        $user->givePermissionTo([
            $user_list,
        ]);
        */
    }
}
