<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $student = [
        //     'name' => 'test student',
        //     'age' => 10,
        // ];

        // DB::table('students')->insert($student);

        Student::factory(50)->create();
    }
}
