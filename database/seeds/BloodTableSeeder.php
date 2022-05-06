<?php

use App\Models\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bloods')->delete();
        $bloods=['A-','A+','B+','B-','O+','O-','AB+','AB-'];
        foreach($bloods as $blood){
            Blood::create(['name'=>$blood]);
        }
    }
}
