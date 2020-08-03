<?php

use Illuminate\Database\Seeder;
use App\Record;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Record::insert([
            [
                'title' => 'All I want for Christmas Is You',
                'artist' => 'Mariah Carey',
                'genre' => 'Christmas',
                'year_released' => '1994',
                'record_label' => 'The Hit Factory, New York City'
            ],
            [
                'title' => 'Circles',
                'artist' => 'Post Malone',
                'genre' => 'Pop Rock',
                'year_released' => '2019',
                'record_label' => 'Republic'
            ],
            [
                'title' => 'The Box',
                'artist' => 'Roddy Ricch',
                'genre' => 'Hip Hop',
                'year_released' => '2020',
                'record_label' => 'Atlantic'
            ],
            [
                'title' => 'Blinding Lights',
                'artist' => 'The Weekend',
                'genre' => 'SynthWave',
                'year_released' => '2019',
                'record_label' => 'XO, Republic'
            ],
            [
                'title' => 'Toosie Slide',
                'artist' => 'Drake',
                'genre' => 'Trap',
                'year_released' => '2020',
                'record_label' => 'Republic, OVO'
            ],
            [
                'title' => 'Stuck with U',
                'artist' => 'Ariana Grande, Justin Bieber',
                'genre' => 'Pop, R&B',
                'year_released' => '2020',
                'record_label' => 'Silent Records Ventures, Def Jam, Republic'
            ],
        ]);
    }
}
