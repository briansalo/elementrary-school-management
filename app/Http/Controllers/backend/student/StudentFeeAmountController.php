<?php

namespace App\Http\Controllers\backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\FeeCategoryAmount;
use App\Models\StudentFee;
use App\Models\StudentPayment;

use DB;
use PDF;

class StudentFeeAmountController extends Controller
{

    public function StudentFeeAmountView(){

        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['fees'] = StudentFee::all();


            return view('backend.student.student_fee.studentfee_view', $data);
    }



    public function RegistrationFeeSearch(Request $request){
           
           $output[] = '';

            $alldata = StudentPayment::where('class_id', $request->class_id)
            ->where('year_id', $request->year)
            ->where('fee_category_id', $request->selectfee)
            ->get();

                foreach($alldata as $row){

                        //computation of discount
                    $amount = $row->amount;
                    $discount = $row->discount;
                    $compute = $discount/100*$amount;
                    $total = $amount-$compute;

                    $color= 'primary';

                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$total.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("registration.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'"> Fee Slip</a>

                        </td>
                    </tr>
                    ';
                }  //end for each

            $data = array(
             'table_data'  => $output
            

             );

            echo json_encode($data);   

          
 
    }  // end method



        public function RegistrationFeePayslip(Request $request){


        
        $data['details'] = StudentPayment::where('student_id',$request->student_id)
        ->where('fee_category_id', $request->fee_category_id)
        ->where('year_id', $request->year)
        ->where('class_id', $request->class)
        ->first();


            // computation for discount
        $dataDiscount = StudentPayment::where('student_id',$request->student_id)
        ->where('fee_category_id', $request->fee_category_id)
        ->where('year_id', $request->year)
        ->where('class_id', $request->class)
        ->first();
                        //computation of discount
                    $amount = $dataDiscount->amount;
                    $discount = $dataDiscount->discount;
                    $compute = $discount/100*$amount;
                    $total = $amount-$compute;
                
         $data['computation'] = $total;
            //end for computation of discount

        
      return view('backend.student.student_fee.studentfee_pdf', $data);

              $pdf = PDF::loadView('backend.student.student_fee.studentfee_pdf', $data);
              
                return $pdf->download('pdf_file.pdf');


        }



    public function MonthlyFeeSearch(Request $request){
        
           
           $output[] = '';

            $alldata = StudentPayment::where('class_id', $request->class_id)
            ->where('year_id', $request->year)
            ->where('fee_category_id', $request->selectfee)
            ->get();

                foreach($alldata as $row){

                    $color= 'primary';

                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("monthly.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'&month='.$request->month_id.'"> Fee Slip</a>

                        </td>
                    </tr>
                    ';
                }  //end for each

            $data = array(
             'table_data'  => $output
            

             );

            echo json_encode($data);   

          
 
    }  // end method




        public function MonthlyFeePayslip(Request $request){
        $data['month'] = $request->month;    
        
        $data['details'] = StudentPayment::where('student_id',$request->student_id)
        ->where('fee_category_id', $request->fee_category_id)
        ->where('year_id', $request->year)
        ->where('class_id', $request->class)
        ->first();
        
      return view('backend.student.student_fee.studentfee_pdf', $data);

              $pdf = PDF::loadView('backend.student.student_fee.studentfee_pdf', $data);
              
                return $pdf->download('pdf_file.pdf');


        }



    public function ExamFeeSearch(Request $request){
            
           
           $output[] = '';

            $alldata = StudentPayment::where('class_id', $request->class_id)
            ->where('year_id', $request->year)
            ->where('fee_category_id', $request->selectfee)
            ->get();

                foreach($alldata as $row){

                    $color= 'primary';

                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("exam.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'&exam='.$request->exam_id.'"> Fee Slip</a>

                        </td>
                    </tr>
                    ';
                }  //end for each

            $data = array(
             'table_data'  => $output
            

             );

            echo json_encode($data);   

          
 
    }  // end method







        public function ExamFeePayslip(Request $request){
            
        $data['exam'] = $request->exam;    
        
        $data['details'] = StudentPayment::where('student_id',$request->student_id)
        ->where('fee_category_id', $request->fee_category_id)
        ->where('year_id', $request->year)
        ->where('class_id', $request->class)
        ->first();
        
      return view('backend.student.student_fee.studentfee_pdf', $data);

              $pdf = PDF::loadView('backend.student.student_fee.studentfee_pdf', $data);
              
                return $pdf->download('pdf_file.pdf');


        }








        public function LiveSearchAction(Request $request){

                // make this variable empty first later on we will pass data here
            $total_row = '';
            $output[] = '';


            $query = $request->get('query'); //this is to get the value of  query variable every input in search field

                //if the user select the registration fee and the query is not null. then we need to calculate the discount
            if($query != '' && $request->selectfee == '2'){
                
                $query_user = User::where('name', 'like', '%'.$query.'%')
                ->orWhere('id_no', 'like', '%'.$query.'%')
                ->get();

                $total_row = $query_user->count(); // as you can see here the variable $total_row is same name variable that we declare in above. so automatically the variable here will pass the data in the same name variable above

                foreach($query_user as $data){

                $alldata = StudentPayment::where('student_id',$data->id)
                    ->where('class_id', $request->class_id)
                    ->where('year_id', $request->year)
                    ->where('fee_category_id', $request->selectfee)
                    ->get();



                foreach($alldata as $row){

                        //computation of discount
                    $amount = $row->amount;
                    $discount = $row->discount;
                    $compute = $discount/100*$amount;
                    $total = $amount-$compute;

                    $color= 'primary';

                    // as you can see here the variable $output[] is same name variable that we declare in above. so automatically the variable here will pass the data in the same name variable above.
                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$total.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("registration.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'"> Fee Slip</a>

                        </td>

                    </tr>
                    ';
                }
                    
                }
            
            
            }

                // if query is null and select fee is registration fee. we need to calculate also the discount here
            else if($query == '' && $request->selectfee == '2'){
                


                $query_user = User::where('name', 'like', '%'.$query.'%')
                ->orWhere('id_no', 'like', '%'.$query.'%')
                ->get();

                $total_row = $query_user->count();

                foreach($query_user as $data){

                $alldata = StudentPayment::where('student_id',$data->id)
                    ->where('class_id', $request->class_id)
                    ->where('year_id', $request->year)
                    ->where('fee_category_id', $request->selectfee)
                    ->get();



                foreach($alldata as $row){

                        //computation of discount
                    $amount = $row->amount;
                    $discount = $row->discount;
                    $compute = $discount/100*$amount;
                    $total = $amount-$compute;

                    $color= 'primary';


                    // as you can see here the variable $output[] is same name variable that we declare in above. so automatically the variable here will pass the data in the same name variable above.
                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$total.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("registration.fee.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'"> Fee Slip</a>

                        </td>             

                    </tr>
                    ';
                }
                    
                }
            
            
            }        
             else if($query != ''){


                $query_user = User::where('name', 'like', '%'.$query.'%')
                ->orWhere('id_no', 'like', '%'.$query.'%')
                ->get();

                $total_row = $query_user->count();

                foreach($query_user as $data){

                $alldata = StudentPayment::where('student_id',$data->id)
                    ->where('class_id', $request->class_id)
                    ->where('year_id', $request->year)
                    ->where('fee_category_id', $request->selectfee)
                    ->get();

                foreach($alldata as $row){

                    $color= 'primary';

                    $output[]= '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("live_search.month_exam.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'&month='.$request->month_id.'&exam='.$request->exam_id.'"> Fee Slip</a>

                        </td>
                    </tr>
                    ';
                }
                    
                }
            



            }else if($query == ''){
                $alldata = StudentPayment::with(['student','student_year'])
                    ->where('class_id', $request->class_id)
                    ->where('year_id', $request->year)
                    ->where('fee_category_id', $request->selectfee)
                    ->get();



                foreach($alldata as $row){

                    $color= 'primary';
                        
                    $output[] = '
                    <tr>
                        <td>'.$row->student->id_no.'</td>
                        <td>'.$row->student->name.'</td>
                        <td>'.$row->student_year->name.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>'.$row->discount.'%'.'</td>
                        <td>'.'₱'.$row->amount.'</td>
                        <td>
                       <a class="btn btn-sm btn-'.$color.'" target="_blanks" href="'.route("live_search.month_exam.payslip").'?student_id='.$row->student_id.'&fee_category_id='.$row->fee_category_id.'&year='.$row->year_id.'&class='.$row->class_id.'&month='.$request->month_id.'&exam='.$request->exam_id.'"> Fee Slip</a>
                    

                    </tr>
                    ';
                }

 
                  
            }

            

            $data = array(
             'table_data'  => $output,
            'total_data'  => $total_row
             );

            echo json_encode($data);


            

        }




        public function LiveSearch_Month_Exam_Payslip(Request $request){
        $data['exam'] = $request->exam;
        $data['month'] = $request->month;    
        
        $data['details'] = StudentPayment::where('student_id',$request->student_id)
        ->where('fee_category_id', $request->fee_category_id)
        ->where('year_id', $request->year)
        ->where('class_id', $request->class)
        ->first();
        
      return view('backend.student.student_fee.studentfee_pdf', $data);

              $pdf = PDF::loadView('backend.student.student_fee.studentfee_pdf', $data);
              
                return $pdf->download('pdf_file.pdf');


        }














}
