<?php

namespace Database\Seeders;

use App\Models\ClassCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['id' => 1, 'name' => 'BSCS', 'slug' => 'bscs', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 2, 'name' => 'BSIT', 'slug' => 'bsit', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 3, 'name' => 'BBA', 'slug' => 'bba', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 4, 'name' => 'MCS', 'slug' => 'mcs', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 5, 'name' => 'BS(ECONOMICS)', 'slug' => 'bs-economics', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 6, 'name' => 'MSC(ECONOMICS)', 'slug' => 'msc-economics', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 7, 'name' => 'MSC(MATHEMATICS)', 'slug' => 'msc-mathematics', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
            ['id' => 8, 'name' => 'MSC(STATICS)', 'slug' => 'msc-statics', 'created_at' => '2023-11-20 09:53:24', 'updated_at' => '2023-11-20 09:53:24'],
        ];
        
        // Sample data for semesters table
        $semesters = [
            ['id' => 1, 'name' => '1', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 2, 'name' => '2', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 3, 'name' => '3', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 4, 'name' => '4', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 5, 'name' => '5', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 6, 'name' => '6', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 7, 'name' => '7', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
            ['id' => 8, 'name' => '8', 'created_at' => '2023-11-24 19:50:05', 'updated_at' => '2023-11-24 19:50:05'],
        ];
        
        // Sample data for sections table
        $sections = [
            ['id' => 1, 'name' => 'A', 'created_at' => '2023-11-21 17:40:38', 'updated_at' => '2023-11-21 17:40:38'],
            ['id' => 2, 'name' => 'B', 'created_at' => '2023-11-21 17:40:38', 'updated_at' => '2023-11-21 17:40:38'],
            ['id' => 3, 'name' => 'C', 'created_at' => '2023-11-21 17:40:38', 'updated_at' => '2023-11-21 17:40:38'],
        ];
        
        // Sample data for classes (generated from the provided data)
        $classes = [];
        foreach ($departments as $department) {
            foreach ($semesters as $semester) {
                foreach ($sections as $section) {
                    $class_name = $department['name'] . ' ' . $semester['name'] . $section['name'];
                    $classes[] = [
                        'name' => $class_name,
                        'department_id' => $department['id'],
                        'semester_id' => $semester['id'],
                        'section_id' => $section['id'],
                        'created_at' => '2023-11-20 09:53:24',
                        'updated_at' => '2023-11-20 09:53:24',
                    ];
                }
            }
        }

        foreach($classes as $class){
            ClassCourse::create($class);
        }
        
    }
}
