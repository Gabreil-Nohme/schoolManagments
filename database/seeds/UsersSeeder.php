<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create( [
            'name'=>'Gabreil Nohme',
            'email'=>'kabreelnohme2016@gmail.com',
            'email_verified_at'=>null,
            'password'=>'$2y$10$KPxRJwGsUNmVFl4m0EJbc.At5FDIT4dxKLet00Jh2UfX/W5G4eTJG',
        ]);
        
    }
}
