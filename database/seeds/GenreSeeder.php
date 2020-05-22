<?php

use App\Genre;
use Illuminate\Database\Seeder;

$GLOBALS['genres'] = [
    'Eccojams',
    'Utopian Virtual',
    'Faux-Utopian',
    'Hypnagogic Drift',
    'Broken Transmission',
    'Mallsoft',
    'Futurevisions',
    'Late Night Lo-Fi',
    'VHS Pop',
    'Future Funk',
    'Vapormeme',
    'Vaportrap'
];
class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Genre::class, sizeof($GLOBALS['genres']))->create();
    }
}
