<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        Role::findByName('user')
            ->givePermissionTo([
                'claim.list',
                'claim.store',
            ]);

        Role::findByName('manager')
            ->givePermissionTo([
                'claim.list',
                'claim.index',
                'claim.show',
                'claim.store',
                'claim.update',
            ]);
    }
}
