<?php

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        Student::create([
            'name'=>['ar'=>'جرجس','en'=>'georges'],
            'email'=>'gogo@gmail.com',
            'password'=>Hash::make('1234567890gg'),
            'gender_id'=>1,
            'nationalitie_id'=>1,
            'blood_id'=>1,
            'Date_Birth'=>'2000-2-4',
            'Grade_id'=>1,
            'Classroom_id'=>1,
            'section_id'=>1,
            'parent_id'=>1,
            'academic_year'=>'2020-2-4'
        ]);
        Student::create([
            'name'=>['ar'=>'سوكو','en'=>'soko'],
            'email'=>'soko@gmail.com',
            'password'=>Hash::make('1234567890gg'),
            'gender_id'=>1,
            'nationalitie_id'=>2,
            'blood_id'=>4,
            'Date_Birth'=>'2001-2-4',
            'Grade_id'=>2,
            'Classroom_id'=>7,
            'section_id'=>14,
            'parent_id'=>1,
            'academic_year'=>'2020-2-4'
        ]);
    }
}
