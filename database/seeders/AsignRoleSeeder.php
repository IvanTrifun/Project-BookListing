<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AsignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('role_type', 'user')->first();
        $adminRole = Role::where('role_type', 'admin')->first();

        // Fetch existing users and assign roles
        User::chunk(100, function ($users) use ($userRole, $adminRole) {
            foreach ($users as $user) {
                $user->roles()->attach($userRole->id);

                // Assign admin role to some users
                if (rand(0, 1) === 1) {
                    $user->roles()->attach($adminRole->id);
                }
            }
        });
    }
}
