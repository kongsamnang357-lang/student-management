<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'adminwoman@gmail.com'],
            ['name' => 'Admin', 'password' => '12345']
        );

        $mis    = Department::create(['dept_name' => 'Management Information System', 'manager_id' => 1, 'location_id' => 1]);
        $design = Department::create(['dept_name' => 'Design', 'manager_id' => 2, 'location_id' => 2]);
        Department::create(['dept_name' => 'Information Technology', 'manager_id' => 3, 'location_id' => 3]);

        $rows = [
            ['Kong Sopheak', 'kongsopheak@gmail.com', 'Male',   '2022-01-01', null, $mis->dept_id],
            ['Ly Chhailin',  'lin@gmail.com',         'Female', '2022-01-01', null, $design->dept_id],
            ['Pov Nita',     'povnita@gmail.com',     'Female', '2023-04-11', 'OK', $mis->dept_id],
            ['Leng Makara',  'lengmakara@gmail.com',  'Male',   '2024-11-01', null, $design->dept_id],
        ];

        foreach ($rows as [$name, $email, $gender, $enroll, $desc, $dept]) {
            Student::create([
                'student_name' => $name, 'email' => $email, 'gender' => $gender,
                'enrollment_date' => $enroll, 'description' => $desc, 'dept_id' => $dept,
            ]);
        }
    }
}
