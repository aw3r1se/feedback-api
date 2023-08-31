<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all();

        User::factory(300)
            ->afterMaking(function (User $user) use ($roles) {
                $user->assignRole(
                    rand(0, 10)
                        ? $roles->firstWhere('name', 'user')
                        : $roles->firstWhere('name', 'manager'),
                );
            })->create();
    }
}
