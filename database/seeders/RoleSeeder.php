<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $roles = [
            ['name' => 'admin', 'description' => 'Admin can access all the modules.'],
            ['name' => 'teacher', 'description' => 'Teacher role is for teachers.'],
            ['name' => 'student', 'description' => 'Student role is for students.'],
          ];

        foreach($roles as $role)
        {
            Role::create($role);
        }
    }

}
