<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subType = new SubscriptionType();
        $subType->name = 'Regular';
        $subType->price = 1000;

        $subType->save();

        $subType = new SubscriptionType();
        $subType->name = 'Child';
        $subType->price = 500;

        $subType->save();

        $subType = new SubscriptionType();
        $subType->name = 'VIP';
        $subType->price = 2500;

        $subType->save();
    }
}
