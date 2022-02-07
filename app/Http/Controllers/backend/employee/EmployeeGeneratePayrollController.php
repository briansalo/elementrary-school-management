<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeGeneratePayroll;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;


class EmployeeGeneratePayrollController extends Controller
{
 
public function EmployeeGeneratePayrollView(){


        $data['alldata'] = User::where('usertype','employee')->get();

        return view('backend.employee.employee_generate_payroll.employee_generate_payroll_view', $data);

        }




public function EmployeeSalaryDateFromToSearch(Request $request){

        $validator = Validator::make($request->all(),[
        'from' => 'required|date',
        'to' => 'required|date|after_or_equal:from',
         ]);

            if($validator->passes()){
                EmployeeGeneratePayroll::where('status','0')->delete();
               }

        $deduction = $request->amount;
        if($request->month != null){
        $month = carbon::create($request->month)->format('(F)');
        }else{
            $month = "";
        }

          $output[] = '';            


            $data = EmployeeAttendance::select('employee_id')
            ->groupBy('employee_id')
            ->whereBetween('date', [$request->from, $request->to])
            ->where('status', '0')
            ->get();


           foreach($data as $key => $row){      

               /////////////// get the late of each employee ///////////////
                    $late = EmployeeAttendance::where('employee_id', $row->employee_id)
                    ->whereBetween('date', [$request->from, $request->to])
                    ->where('status', '0')
                    ->get();
                   // dd($late);
                    $get_late = [];                              
                          //for loop the $late variable above and store it in $get_late variable  
                        foreach($late as $value){
                            $get_late[] = $value->late;
                        }

              /////////////// get the overtime of each employee ///////////////
                    $overtime = EmployeeAttendance::where('employee_id', $row->employee_id)
                    ->whereBetween('date', [$request->from, $request->to])
                    ->where('status', '0')
                    ->get();

                    $get_overtime = [];            
                            // for loop the $overtime and store it in $get_overtime
                        foreach($overtime as $value){
                    $get_overtime[] = $value->overtime;
                        }

                            
                  /////////////// get the attendance of each employee ///////////////
                    $attendance = EmployeeAttendance::where('employee_id', $row->employee_id)
                    ->where('attendance_status','present')
                    ->whereBetween('date', [$request->from, $request->to])
                    ->where('status', '0')
                    ->get();   

                    
                /////////////// get the firstdate of the covered date that show in table ///////////////
                     $firstdate = EmployeeAttendance::where('employee_id', $row->employee_id)
                    //->where('attendance_status','present')
                    ->whereBetween('date', [$request->from, $request->to])
                    ->orderBy('date', 'asc')
                    ->where('status', '0')
                    ->first();

                  /////////////// get the lastdate of the covered date that show in table ///////////////
                     $lastdate = EmployeeAttendance::where('employee_id', $row->employee_id)
                    //->where('attendance_status','present')
                    ->whereBetween('date', [$request->from, $request->to])
                    ->orderBy('date', 'desc')
                    ->where('status', '0')
                    ->first();


              ////////////////////// computation ///////////////////////

                    $no_of_days = $attendance->count();

                    $computesubtotal= $no_of_days*$row->user->salary;

                    $salary =  $row->user->salary;

                    $perhour = $salary/8;

                    $overtime = array_sum($get_overtime);
                    $computeovertime = $overtime*$perhour;

                    $computededuction = $deduction;

                //////////////////////// Late Computation/////////////
                    $get_first=[];
                    $get_second=[];
                        for($x=0; $x<count($get_late); $x++){
                             $separate = explode('.', $get_late[$x]);
                             $get_first[] = $separate[0];
                             $get_second[] = @$separate[1];
                         }//end if

                    $hour=array_sum($get_first);
                    $minute=array_sum($get_second);
                   

                    if($minute<=60){
                        $divide = $minute/60;
                        $total_of_divide = $divide;
                    }else{
                       $divide = $minute/60;
                       $get_split = explode('.', $divide);
                       $total_of_divide = $get_split[0];
                    }

                    if($total_of_divide>=1){
                        $compute_minute = $minute-(60*$total_of_divide);

                            if($compute_minute<10){
                                $get_minute = ".0".$compute_minute;
                            }else{
                                $get_minute = ".".$compute_minute;
                            }
                            $get_hour = $hour + $total_of_divide;
                            $late = $get_hour.$get_minute;

                    }else{
                     $late = $hour.".".$minute;
                    }
                    
                    $split = explode('.', $late);
                   //this @ sign might help to you if your facing an error to undefined an array key but if youre going to see or dd the variable and the array key that undefined is existing 
                    $get_first = $perhour* $split[0];
                    $get_second = $perhour/60 * @$split[1];
                    
                    $computelate = $get_first+$get_second;


                    $total = $salary*$no_of_days-$computelate+$computeovertime-$computededuction;


                    $output[]= '
                    <tr>
                       
                        <td>'.ucwords($row->user->name).'</td>
                        <td>'."From ".$firstdate->date." To ".$lastdate->date.'</td>
                        <td>'."₱".number_format($salary,).'</td>
                        <td>'.$no_of_days.'</td>
                        <td>'."₱".$computesubtotal.'</td>
                        <td>'. number_format($late, 2).'</td>
                        <td>'. $overtime.'</td>
                        <td>'. $deduction."$month".'</td>
                        <td>'."₱".number_format($total,2).'</td>
                        
                     </tr>
                    ';

                $new = new EmployeeGeneratePayroll();
                $new->employee_id = $row->employee_id;
                $new->from = $firstdate->date;
                $new->to = $lastdate->date;
                $new->salary= $salary;
                $new->no_of_days= $no_of_days;
                $new->sub_total = $computesubtotal;
                $new->late = $late;
                $new->overtime = $overtime;
                $new->deduction= $deduction;
                $new->total_salary= $total;
                $new->save();

           }  //end for each

                // checking the validator
                if($validator->passes()){    
                     return response()->json($output);
                }else{
                      $data = "invalid_date";
                     return response()->json($data);
                }//end if


}   



public function EmployeeAttendanceGenerateStore(Request $request){


        $deduction = $request->amount;

        //dd($request->all());
            $no_of_days = []; 
            $get_late = []; 
            $get_overtime = [];
            $perhour = [];
            $total_salary=[];


          $data['details'] = EmployeeAttendance::select('employee_id')
            ->groupBy('employee_id')
            ->whereBetween('date', [$request->from, $request->to])
            ->where('status', '0')
            ->get();


           foreach($data['details'] as $row){      


             //////////////////////////get the firstdate of the covered date that show in web /////////////////////
                         $data['firstdate'] = EmployeeAttendance::where('employee_id', $row->employee_id)
                        ->whereBetween('date', [$request->from, $request->to])
                        ->orderBy('date', 'asc')
                        ->where('status', '0')
                        ->first();
                       // dd($data['firstdate']->date);



             /////////////// get the lastdate of the covered date that show in web ///////////////
                         $data['lastdate'] = EmployeeAttendance::where('employee_id', $row->employee_id)
                        //->where('attendance_status','present')
                        ->whereBetween('date', [$request->from, $request->to])
                        ->orderBy('date', 'desc')
                        ->where('status', '0')
                        ->first();


                                
                        $alldata = EmployeeGeneratePayroll::where('from',$data['firstdate']->date)
                                ->where('to',$data['lastdate']->date)
                                ->where('status', '0')
                                ->get();
                            foreach($alldata as $second_row){
                                $get_late[]= $second_row->late;
                                $get_overtime[]= $second_row->overtime;
                                $perhour[]= $second_row->salary;
                                $no_of_days[]= $second_row->no_of_days;
                                $total_salary[]= $second_row->total_salary;
                             }//end foreach

            //////////////////////// update the status of the user to 1 it means it's already generated///////////      
                             EmployeeGeneratePayroll::where('employee_id', $row->employee_id)
                                ->where('from',$data['firstdate']->date)
                                ->where('to',$data['lastdate']->date)
                                ->where('status', '0')
                                ->update(['status'=>1]);

            //////////////////////// update the status of the user to 1 it means it's already generated/////////// 
                         EmployeeAttendance::where('employee_id', $row->employee_id)
                            ->whereBetween('date', [$request->from, $request->to])
                            ->where('status', '0')
                            ->update(['status' => 1]);
                    
                             // per hour of each employee
                             $perhour[] = $row->user->salary/8;


             }//end foeach  


             

        return view('backend.employee.employee_generate_payroll.employee_generate_payroll_pdf', $data)
        ->with(compact('no_of_days', 'get_late', 'get_overtime','deduction','perhour','total_salary'));


}




}//end of class
