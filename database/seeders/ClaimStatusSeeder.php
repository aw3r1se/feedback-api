<?php

namespace Database\Seeders;

use App\Models\ClaimStatus;
use Illuminate\Database\Seeder;

class ClaimStatusSeeder extends Seeder
{
    public function run(): void
    {
        ClaimStatus::query()
            ->insert([
                ['name' => 'received'],
                ['name' => 'processing'],
                ['name' => 'closed'],
            ]);
    }
}
