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
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'teacher',
            ],
            [
                'role_name' => 'student',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
