<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Session;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UtmleadAdministrator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // utmleadAdmin
        $utmleadAdmin = UtmleadAdministrator::create([
            'staffID' => '111111'
        ]);

        $user = User::create([
            'utmID' => 'nihra',
            'name' => 'Profesor Madya Dr. Mohd Nihra Haruzuan Bin Mohamad Said',
            'photo' => 'https://www.utm.my/directory/image.php?nopekerja=8630',
            'email' => 'nihra@utm.my',
            'password' => Hash::make('nihra'),
        ]);

        $utmleadAdmin->user()->save($user);

        // lecturer
        $lecturer = Lecturer::create([
            'staffID' => '222222',
            'faculty' => 'Engineering',
            'school' => 'Computing'
        ]);

        $user = User::create([
            'utmID' => 'noraini',
            'name' => 'Dr. Noraini Binti Ibrahim',
            'photo' => 'https://www.utm.my/directory/image.php?nopekerja=9301',
            'email' => 'noraini_ib@utm.my',
            'password' => Hash::make('noraini'),
        ]);

        $lecturer->user()->save($user);

        //student
        $student = Student::create([
            'matricNo' => 'A18CS0154',
        ]);

        $user = User::create([
            'utmID' => 'asyraaf',
            'name' => 'Muhammad Nazirul Asyraaf Bin Halid',
            'photo' => 'http://academic.utm.my/UGStudent/PhotoStudent.ashx?nokp=990316015619',
            'email' => 'mn.asyraaf@graduate.utm.my',
            'password' => Hash::make('asyraaf'),
        ]);

        $student->user()->save($user);

        //session
        $session = Session::create([
            'name' => '2021/2022',
            'semester' => 2,
            'startSetFrom' => Carbon::create('2022', '5', '1'),
            'endSetForm' => Carbon::create('2022', '5', '31'),
            'startAnswer' => Carbon::create('2022', '6', '1'),
            'endAnswer' => Carbon::create('2022', '6', '30')
        ]);

        //course
        $course = Course::create([
            "section" => 3,
            "code" => "SCSD 2613",
            "title" => "System Analysis and Design",
            "isChecked" => false,
            "lecturerID" => $lecturer->id,
            'sessionID' => $session->id,
        ]);

        DB::table('joinStudentToCourse')->insertTs([
            'studentID' => $student->id,
            'courseID' => $course->id,
        ]);

        $course = Course::create([
            "section" => 1,
            "code" => "SCSJ 2253",
            "title" => "Requirements Engineering and Software Modeling",
            "isChecked" => false,
            "lecturerID" => $lecturer->id,
            'sessionID' => $session->id,
        ]);

        DB::table('joinStudentToCourse')->insertTs([
            'studentID' => $student->id,
            'courseID' => $course->id,
        ]);
    }
}
