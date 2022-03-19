<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Products
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'products.delete']);
        //Sales
        Permission::create(['name' => 'sales.index']);
        Permission::create(['name' => 'sales.create']);
        Permission::create(['name' => 'sales.edit']);
        Permission::create(['name' => 'sales.delete']);
        //Users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);

        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $role = Role::create([
            'name' => 'Seller',
            'guard_name' => 'web',
        ]);
        $role->syncPermissions([
            // Products
            ['name' => 'products.index'],
            //Sales
            ['name' => 'sales.index'],
            ['name' => 'sales.create'],
        ]);
    }
}
