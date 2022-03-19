<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrcreate(
            [
                'username' => 'superadmin',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@test.com',
                'password' => bcrypt('superadmin123')
            ]
        );
        $user->syncRoles(['Super Admin']);

        $user = User::firstOrcreate(
            [
                'username' => 'cajero',
            ],
            [
                'name' => 'Cajero',
                'email' => 'cajero@test.com',
                'password' => bcrypt('cajero123')
            ]
        );
        $user->syncRoles(['Seller']);
    }
}
