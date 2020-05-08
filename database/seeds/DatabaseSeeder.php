<?php

use App\Role;
use App\Format;
use App\Colour;
use App\Genre;
use App\User;
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
        $this->call(LabelSeeder::class);
        $this->call(ArtistSeeder::class);
        if (sizeof(Genre::all()) === 0) {
            $this->call(GenreSeeder::class);
        }
        if (sizeof(Format::all()) === 0) {
            $this->call(FormatSeeder::class);
        }
        if (sizeof(Colour::all()) === 0) {
            $this->call(ColourSeeder::class);
        }
        $this->call(RecordSeeder::class);
        if (sizeof(Role::all()) === 0) {
            $this->call(RoleSeeder::class);    
        }
        if (sizeOf(User::all()) === 0) {
            $this->call(UserSeeder::class);
        }
    }
}
