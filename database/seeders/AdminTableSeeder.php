<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('users')->delete();
            $user = array(
                array('id' => 1, 'usertype'=>'Admin', 'name'=>'admin',  'email'=>'admin@admin.com', 'email_verified_at'=> now(), 'password'=> bcrypt('adminadmin') ),
                
                );
                DB::table('users')->insert($user);
    }


}
