<?php

use App\Orderable;
use Illuminate\Database\Seeder;

class OrderablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Orderable::class,100)->create();
    }
}
