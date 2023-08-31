<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\ClaimStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClaimSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ClaimStatus::all();
        $users = User::role('user')->get();

        Claim::factory(200)
            ->afterMaking(function (Claim $claim) use ($statuses, $users) {
                /** @var ClaimStatus $status */
                $status = $statuses->random();
                $user = $users->random();

                $claim->user()
                    ->associate($user);
                $claim->status()
                    ->associate($status);
            })->create();
    }
}
