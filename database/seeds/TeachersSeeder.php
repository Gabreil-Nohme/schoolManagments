<?php

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();
        Teacher::create([
            'Email'=>'teacher@gmail.com',
            'Password'=>Hash::make('1234567890gg'),
            'Name'=>['ar'=>'سامر','en'=>'samer'],
            'Specialization_id'=>1,
            'Gender_id'=>1,
            'Joining_Date'=>'2022-05-04',
            'Address'=>'hama'
        ]);
        Teacher::create([
            'Email'=>'teacher2@gmail.com',
            'Password'=>Hash::make('1234567890gg'),
            'Name'=>['ar'=>'مازن','en'=>'mazen'],
            'Specialization_id'=>2,
            'Gender_id'=>1,
            'Joining_Date'=>'2022-05-04',
            'Address'=>'homs'
        ]);

        

    }
}
