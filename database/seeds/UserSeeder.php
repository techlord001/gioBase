<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'name' => "test",
            'email' => "test@testing.test",
            'email_verified_at' => now(),
            'password' => bcrypt("test1234"), // password
            'role_id' => 4,
            'remember_token' => Str::random(10),
        ]);

        factory(User::class, 4)->create();
    }
}
