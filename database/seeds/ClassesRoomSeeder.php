<?php

use App\Models\ClassRooms;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classroom')->delete();
        ClassRooms::create([

            'name_class'=>['ar'=>'الصف الاول','en'=>'the One Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الثاني','en'=>'the secound Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الثالث','en'=>'the third Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الرابع','en'=>'the four Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الخامس','en'=>'the five Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف السادس','en'=>'the six Class'],
            'grades_id'=>1
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف السابع','en'=>'the seven Class'],
            'grades_id'=>2
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الثامن','en'=>'the eight Class'],
            'grades_id'=>2
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف التاسع','en'=>'the nine Class'],
            'grades_id'=>2
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف العاشر','en'=>'the ten Class'],
            'grades_id'=>3
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الحادي عشر','en'=>'the eleven Class'],
            'grades_id'=>3
        ]);
        ClassRooms::create([
            'name_class'=>['ar'=>'الصف الثاني عشر','en'=>'the twilve Class'],
            'grades_id'=>3
        ]);


    }
}
