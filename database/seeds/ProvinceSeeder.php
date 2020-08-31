<?php

use App\State;
use App\Area;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seed lagos state
         */
        $provinces = json_decode('[{"state": {"name": "Lagos State", "id":1, "locals": [{"name":"Ajeromi-Ifelodun","id":1},{"name":"Alimosho","id":2},{"name":"Amuwo-Odofin","id":3},{"name":"Apapa","id":4},{"name":"Badagry","id":5},{"name":"Epe","id":6},{"name":"Eti Osa","id":7},{"name":"Ibeju-Lekki","id":8},{"name":"Ifako-Ijaiye","id":9},{"name":"Ikeja","id":10},{"name":"Ikorodu","id":11},{"name":"Kosofe","id":12},{"name":"Lagos Island","id":13},{"name":"Lagos Mainland","id":14},{"name":"Mushin","id":15},{"name":"Ojo","id":16},{"name":"Oshodi-Isolo","id":17},{"name":"Shomolu","id":18},{"name":"Surulere","id":19}]}}]',true);

        foreach($provinces as $state){
            $state_name = str_replace(' State', '', $state['state']['name']);
            $State = new State();
            $State->name = $state_name;
            $State->save();
            foreach($state['state']['locals'] as $area){
                $Area = new Area();
                $Area->name = $area['name'];
                $Area->state()->associate($State);
                $Area->save();
            }
        }
    }
}
