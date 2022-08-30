<?php

use App\Models\My_Parent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MyParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my__parents')->delete();
        My_Parent::create([
            'email'=>'baba@gmail.com',
            'password'=>Hash::make('1234567890gg'),
            'Name_Father'=>['ar'=>'جون','en'=>'john'],
            'National_ID_Father'=>1234567890,
            'Passport_ID_Father'=>1234567890,
            'Phone_Father'=>1234567890,
            'Job_Father'=>['ar'=>'نجار','en'=>'carpenter'],
            'Nationality_Father_id'=>1,
            'Blood_Type_Father_id'=>1,
            'Religion_Father_id'=>1,
            'Address_Father'=>Str::random(10),
            'Name_Mother'=>['ar'=>'سمر','en'=>'samar'],
            'National_ID_Mother'=>1234567899,
            'Passport_ID_Mother'=>1234567899,
            'Phone_Mother'=>1234567899,
            'Job_Mother'=>['ar'=>'نجار','en'=>'carpenter'],
            'Nationality_Mother_id'=>2,
            'Blood_Type_Mother_id'=>2,
            'Religion_Mother_id'=>2,
            'Address_Mother'=>Str::random(10),
        ]);
        My_Parent::create([
            'Email'=>'baba2@gmail.com',
            'Password'=>Hash::make('1234567890gg'),
            'Name_Father'=>['ar'=>'مايكل','en'=>'michel'],
            'National_ID_Father'=>1234567800,
            'Passport_ID_Father'=>1234567800,
            'Phone_Father'=>1234567800,
            'Job_Father'=>['ar'=>'نادل','en'=>'waiter'],
            'Nationality_Father_id'=>2,
            'Blood_Type_Father_id'=>2,
            'Religion_Father_id'=>2,
            'Address_Father'=>Str::random(10),
            'Name_Mother'=>['ar'=>'قمر','en'=>'quamar'],
            'National_ID_Mother'=>1234567999,
            'Passport_ID_Mother'=>1234567999,
            'Phone_Mother'=>1234567999,
            'Job_Mother'=>['ar'=>'نادلة','en'=>'waitress'],
            'Nationality_Mother_id'=>1,
            'Blood_Type_Mother_id'=>1,
            'Religion_Mother_id'=>1,
            'Address_Mother'=>Str::random(10),
        ]);
    }
}
