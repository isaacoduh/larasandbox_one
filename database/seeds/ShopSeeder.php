<?php

use App\Shop;
use App\State;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $shop = new Shop();

        $shop->name = $faker->name;
        $shop->address = $faker->address;
        $shop->state()->associate(State::has('areas')->inRandomOrder()->first());
        $shop->area()->associate($shop->state->areas()->inRandomOrder()->first());
        $shop->user()->associate(User::inRandomOrder()->first());
        $shop->save();

        for($i = 0; $i < 50; $i++){
            $shop = new Shop();
            $shop->name = $faker->name;
            $shop->address = $faker->address;
            $shop->state()->associate(State::has('areas')->inRandomOrder()->first());
            $shop->area()->associate($shop->state->areas()->inRandomOrder()->first());
            $shop->user()->associate(User::inRandomOrder()->first());
            $shop->save();
        }
    }
}
