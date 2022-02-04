<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\EmployeeSallaryLog;
use Carbon\Carbon;


class EffectiveSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:EffectiveSalary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $today = Carbon::now();

            //condition if the date today is same date on effective_salary in table employesallarylog then get all the data
        $user = EmployeeSallaryLog::whereDate('effective_salary','=', date('Y-m-d',strtotime($today)))
        ->where('status', '1')
        ->get();

        foreach($user as $value){ 
        $present_salary = $value->present_salary;
    
                //update the salary of the user 
             $salary = User::find($value->employee_id);

             $salary->salary_increase_status = "0";
            $salary->salary = $present_salary;
              $salary->save();

              // update the status of the user in employeesallarylog
         $salarydata = EmployeeSallaryLog::where('status','1')
         ->where('employee_id',$value->employee_id)
         ->first();

         $salarydata->status = '2';
         $salarydata->save();
        }//end for each

    } // end public function handle
}
