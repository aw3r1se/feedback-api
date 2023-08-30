<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'user'],
            ['name' => 'manager'],
        ])->each(function (array $role) {
            Role::query()
                ->create($role);
        });
    }
}
