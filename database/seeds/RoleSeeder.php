<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Role::class, sizeof($GLOBALS['roles']))->create();

        $roles = [
            [
                'role' => 'Member'
            ],
            [
                'role' => 'Contributor'
            ],
            [
                'role' => 'Admin'
            ],
            [
                'role' => 'Master'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
