<?php

use App\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Format::class, sizeof($GLOBALS['formats']))->create();
    }
}
