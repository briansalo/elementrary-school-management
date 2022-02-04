<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\EmployeeSallaryLog;


use Carbon\Carbon;

class EmployeeSalaryController extends Controller
{
    public function EmployeeSalaryView(){


       $data['alldata'] = User::where('usertype', 'employee')->get();


        return view('backend.employee.employee_salary.employee_salary_view', $data);
    }


        public function EmployeeSalaryIncrement($id){

        $data['alldata'] = User::find($id);

        return view('backend.employee.employee_salary.employee_salary_increment', $data);                

        }

        public function EmployeeSalaryUpdateIncrement(Request $request, $id){


              $now = Carbon::today();

                
                $salary = User::find($id);
                $salary->salary_increase_status = '1';
                 $salary->save();

                $previous_salary = $salary->salary;
                $present_salary = (float)$previous_salary+(float)$request->increment_salary; 


                
                $salarydata = new EmployeeSallaryLog();
                $salarydata->employee_id = $id;
                $salarydata->previous_salary = $previous_salary;
                $salarydata->present_salary = $present_salary;
                $salarydata->increment_salary = $request->increment_salary;
                $salarydata->effective_salary = date('Y-m-d',strtotime($request->effective_salary));
                $salarydata->status = '1';
                $salarydata->save();

               



        $notification = array(
            'message' => 'Salary Increment Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.salary.view')->with($notification);

        }



        public function EmployeeSalaryCancelIncrement($id){

          // update the salary increase status of user
          $salary = User::find($id);
         $salary->salary_increase_status = '0';
         $salary->save();
        
        // updaye the status of user in employeesallarylog table        
         $salarydata = EmployeeSallaryLog::where('status','1')
         ->where('employee_id',$id)
         ->first();
    
          $salarydata->status = '0';
          $salarydata->save();
        
      

        $notification = array(
            'message' => 'Salary Cancel Increment Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.salary.view')->with($notification);

        }



        public function EmployeeSalaryDetails($id){
          
          $data['data'] = User::find($id);

          $data['alldata'] = EmployeeSallaryLog::where('employee_id', $id)->get();
        //  dd($data);

        return view('backend.employee.employee_salary.employee_salary_details', $data);

        }

}
