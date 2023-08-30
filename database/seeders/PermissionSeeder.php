<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'claim.list'],
            ['name' => 'claim.index'],
            ['name' => 'claim.show'],
            ['name' => 'claim.store'],
            ['name' => 'claim.update'],
        ])->each(function (array $permission) {
           Permission::query()
               ->create($permission);
        });
    }
}
