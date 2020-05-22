<?php

use App\Format;
use Illuminate\Database\Seeder;

$GLOBALS['formats'] = [
    '7" Vinyl',
    '12" Vinyl',
    'Cassette',
    'Digital'
];
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
