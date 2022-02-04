<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class StudentFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('student_fees')->delete();
            $studentfee = array(
                array('id' => 2,'name'=>'Registration Fee'),
                array('id' => 3,'name'=>'Exam Fee'),
                array('id' => 4,'name'=>'Monthly Fee'), 

                );
                DB::table('student_fees')->insert($studentfee);

    }
}
