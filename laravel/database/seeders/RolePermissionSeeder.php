<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate to make it repeatable (clears old data)
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        User::truncate();
        Role::truncate();
        Permission::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $staff = Role::create(['name' => 'staff']);

        // Create permissions
        $permissions = [
            'users.manage',
            'products.create',
            'products.update',
            'products.delete',
            'category.create',
            'category.update',
            'category.delete',
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Assign all permissions to admin
        $admin->permissions()->attach(Permission::all());

        // Assign some permissions to manager
        $manager->permissions()->attach(
            Permission::whereIn('name', [
                'products.create',
                'products.update',
                'products.delete',
                'category.create',
                'category.update',
            ])->get()
        );

        // Assign limited permissions to staff
        $staff->permissions()->attach(
            Permission::where('name', 'products.create')->first()
        );

        // Create users
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $adminUser->roles()->attach($admin);

        $managerUser = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);
        $managerUser->roles()->attach($manager);

        $staff1 = User::create([
            'name' => 'Staff One',
            'email' => 'staff1@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff1->roles()->attach($staff);

        $staff2 = User::create([
            'name' => 'Staff Two',
            'email' => 'staff2@example.com',
            'password' => Hash::make('password'),
        ]);
        $staff2->roles()->attach($staff);
    }
}
