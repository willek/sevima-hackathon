<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $checkRole = Role::where('name', 'admin')->orWhere('name', 'security')->exists();
        $checkUsers = User::where('email', 'admin@mail.com')
            ->orWhere('email', 'security1@mail.com')
            ->orWhere('email', 'security2@mail.com')
            ->exists();

        // skip seeder
        if ($checkRole && $checkUsers) {
            return;
        }

        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($adminRole);

        $securityRole = Role::create(['name' => 'security']);

        $security1 = User::create([
            'name' => 'Security1',
            'email' => 'security1@mail.com',
            'password' => bcrypt('password')
        ]);

        $security2 = User::create([
            'name' => 'Security2',
            'email' => 'security2@mail.com',
            'password' => bcrypt('password')
        ]);

        $security1->assignRole($securityRole);
        $security2->assignRole($securityRole);
    }
}
