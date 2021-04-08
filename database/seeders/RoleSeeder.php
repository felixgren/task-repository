<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $roles = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'teacher',
            ],
            [
                'name' => 'student',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
