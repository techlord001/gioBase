<?php

use App\Artist;
use App\Format;
use App\Colour;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LabelSeeder::class);
        $this->call(ArtistSeeder::class);
        $this->call(RecordSeeder::class);
        if (sizeof(Format::all()) === 0) {
            $this->call(FormatSeeder::class);
        }
        if (sizeof(Colour::all()) === 0) {
            $this->call(ColourSeeder::class);
        }
    }
}
