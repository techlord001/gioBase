<?php

use App\Colour;
use Illuminate\Database\Seeder;

class ColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Colour::class, sizeof($GLOBALS['colours']))->create();
    }
}
