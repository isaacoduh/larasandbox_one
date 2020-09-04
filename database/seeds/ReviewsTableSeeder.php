<?php

use App\Orderable;
use App\Review;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orderable::all()->each(function(Orderable $orderable){
            $reviews = factory(Review::class, random_int(5,30))->make();
            $orderable->reviews()->saveMany($reviews);
        });
    }
}
