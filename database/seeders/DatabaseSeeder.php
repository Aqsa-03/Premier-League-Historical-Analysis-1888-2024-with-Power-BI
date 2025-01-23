<?php

namespace Database\Seeders;

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
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(ClassCourseSeeder::class);
    }
}

