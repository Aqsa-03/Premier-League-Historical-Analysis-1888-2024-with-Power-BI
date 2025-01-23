<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'BSCS', 'slug' => 'BSCS'],
            ['name' => 'BSIT', 'slug' => 'BSIT'],
            ['name' => 'BBA', 'slug' => 'BBA'],
            ['name' => 'MCS', 'slug' => 'MCS'],
            ['name' => 'BS(ECONOMICS)', 'slug' => 'BS-ECONOMICS'],
            ['name' => 'MSC(ECONOMICS)', 'slug' => 'MSC-ECONOMICS'],
            ['name' => 'MSC(MATHEMATICS)', 'slug' => 'MSC-MATHEMATICS'],
            ['name' => 'MSC(STATICS)', 'slug' => 'MSC-STATICS'],
        ];

        foreach($departments as $department)
        {
            Department::create($department);

        }
    }
}
