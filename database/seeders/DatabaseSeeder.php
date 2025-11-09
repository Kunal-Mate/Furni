<?php

namespace Database\Seeders;

use App\Models\Admin;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([CategorySeeder::class, ProductSeeder::class]);

        $superAdmin = Admin::firstOrCreate(
            ['email' => 'superadmin@sitwellchairs.com'],
            [
                'name' => 'SuperAdmin',
                'password' => Hash::make('1234'),
                'userType' => 'superAdmin',
            ]
        );
        $admin = User::firstOrCreate(
            ['email' => 'admin@sitwellchairs.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('1234'),
                'userType' => 'admin',
            ]
        );



        // role
        $superAdminRole = Role::firstOrCreate([
            'name' => 'superAdmin',
            'guard_name' => 'admin',
            'adminId' => $superAdmin->id,
        ]);
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'admin',
            'adminId' => $superAdmin->id,
        ]);

        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions(
            Permission::whereIn('name', ['manage users', 'view dashboard'])->get()
        );


        DB::table('model_has_roles')->insert([
            [
                'role_id' => $superAdminRole->id,
                'model_type' => 'App\Models\Admin',
                'model_id' => $superAdmin->id,
            ],
            [
                'role_id' => $adminRole->id,
                'model_type' => 'App\Models\Admin',
                'model_id' => $admin->id,
            ],

        ]);
    }
}
