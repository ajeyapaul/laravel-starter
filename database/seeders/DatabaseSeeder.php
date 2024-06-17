<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        $superAdminUser = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'system@admin.com',
            'password' => Hash::make('password'),
        ])->assignRole(RolesEnum::SUPERADMIN->value);

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ])->assignRole(RolesEnum::ADMIN->value);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ])->assignRole(RolesEnum::USER->value);

        User::factory()
            ->count(20)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RolesEnum::USER->value);
            });
    }
}
