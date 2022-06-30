<?php

use App\Models\Blood;
use App\Models\Nationalitie;
use App\Models\Specialization;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

     //php artisan db:seed
    public function run()
    {
         $this->call(BloodTableSeeder::class);
         $this->call(NatiolatiesTableSeeder::class);
         $this->call(ReligionTableSeeder::class);
         $this->call(GradeTableSeeder::class);
         $this->call(GenderTableSeeder::class);
         $this->call(SpecializationTableSeeder::class);
         $this->call(UsersSeeder::class);
         $this->call(ClassesRoomSeeder::class);
         $this->call(SectionSeeder::class);
         $this->call(MyParentSeeder::class);
         $this->call(TeachersSeeder::class);
         $this->call(StudentsSeeder::class);
         $this->call(SettingTableSedder::class);

    }
}
