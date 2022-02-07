<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\EmployeeSallaryLog;
use App\Models\EmployeeAttendance;

use Carbon\Carbon;

class EmployeeMonthlySalaryController extends Controller
{
        public function EmployeeMonthlySalaryView(){

        $data['alldata'] = User::where('usertype','employee')->get();

        return view('backend.employee.employee_month_salary.employee_monthly_salary_view', $data);
        }


        public function EmployeeMonthlySalaryMonthSearch(Request $request){

            $new1 = date('m-Y', strtotime($request->month_id));


            $today = Carbon::now()->startOfMonth();

            $selected_month = Carbon::create($request->month_id);

            if($today->greaterThan($selected_month)){
                
                  $output[] = '';

                    $data = EmployeeAttendance::select('employee_id')
                    ->groupBy('employee_id')
                    ->where('date', 'like', '%'.$request->month_id.'%')->get();
                


                        foreach($data as $row){

                                //this is to get the attendance of user
                    $attendance = EmployeeAttendance::where('employee_id', $row->employee_id)
                    ->where('attendance_status','present')
                    ->where('date', 'like', '%'.$request->month_id.'%')
                    ->get();

                            $color= 'primary';

                            $output[]= '
                            <tr>
                                <td>'.$row->user->id_no.'</td>
                                <td>'.ucwords($row->user->name).'</td>
                                <td>'."₱".number_format($row->user->salary,).'</td>
                                <td>'.$attendance->count().'</td>
                                <td>'."₱".number_format($attendance->count()*$row->user->salary,).'</td>
                                <td>
                               <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("registration.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'"> Fee Slip</a>

                                </td>
                            </tr>
                            ';
                        }  //end for each

                        return response()->json($output);


                }else{  

                              $data = "higher_month";
                             return response()->json($data);
                }

 



            
    } // end of method


        


        public function EmployeeAttendanceGenerateStore(Request $request){

            $data = EmployeeAttendance::whereBetween('date', [$request->from, $request->to])
            ->where('attendance_status', 'present')
            ->get();

            $number = count($request->employee_id);
           // dd($number);
            for($i=0; $i< $number; $i++ ){
            
                 $data1 = EmployeeAttendance::whereBetween('date', [$request->from, $request->to])
                ->where('employee_id', $request->employee_id[$i])
                ->update(['status' => '1']);                
                 
            }//end for each






        return view('backend.employee.employee_month_salary.employee_monthly_salary_view', $data);

        }


}
