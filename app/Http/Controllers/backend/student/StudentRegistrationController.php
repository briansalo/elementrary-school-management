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
use App\Models\StudentPayment;
use App\Models\StudentFee;
use App\Models\FeeCategoryAmount;
use App\Models\StudentGrade;

use DB;
use PDF;
use Carbon\Carbon;
class StudentRegistrationController extends Controller
{
        Public function StudentRegistrationView(){
            $data['class'] = StudentClass::all();
            $data['grade'] = StudentGrade::all();

            $data['alldata'] = AssignStudent::orderBy('id','desc')->get();
             
            return view('backend.student.student_reg.student_view', $data);

        }

        public function StudentRegistrationAdd(){
            $data['grades'] = StudentGrade::all();
            $data['class'] = StudentClass::all();
            $data['year'] = StudentYear::all();
            $data['group'] = StudentGroup::all();
            $data['shift'] = StudentShift::all();
            return view('backend.student.student_reg.student_add', $data);
        }

        public function StudentRegistrationStore(Request $request){

            // use db transaction for inserting multiple table. the usage of this is you can get the latest data that inserted and use it to other table. dont forget to declare the db at the top to use this
            DB::transaction(function() use($request){ 

                // TO generate THE I.D. NO. OF THE STUDENT
                $checkyear = Carbon::now()->format('Y');
                $student = User::where('usertype','student')->orderBy('id','DESC')->first();
                
                //this condition if theres no student register yet in the table 
                if($student == null){
                    $id_no = '0001';
                }else{
                    
                   $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;  
                   $studentid = $student+1; 
                
                     if($studentid <10){
                            $id_no = '000'.$studentid;
                    }elseif($studentid  < 100){
                            $id_no = '00'.$studentid;  
                     }elseif($studentid < 1000){
                            $id_no = '0'.$studentid;
                     }

                    }// end else
                    $final_id = $checkyear.$id_no;


                    $user = new User();
                    $code = rand(0000,9999); // creating random password
                    $user->id_no = $final_id;
                    $user->password = bcrypt($code);
                    $user->usertype = 'student';
                    $user->code = $code;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->mothers_name = $request->mothers_name;
                    $user->fathers_name = $request->fathers_name;
                    $user->mobile_number = $request->mobile_number;
                    $user->address = $request->address;
                    $user->gender = $request->gender;
                    $user->religion = $request->religion;
                    $user->dob = date('Y-m-d',strtotime($request->dob));
                    $user->gender = $request->gender;

                    if($request->file('image')){  // if there's an image
                        $file= $request->file('image'); // store the image in the variable
                        $filename = date('YmdHi').$file->getClientOriginalName(); // make own name of the images
                        $file->move(public_path('upload/student_images'),$filename); //location of the storage
                        $user['image'] = $filename;                        
                    }
                    $user->save();

                    $assign_student = new AssignStudent();
                    $assign_student->student_id = $user->id; // we can get the latest user id that inserted because we are using db transaction
                    $assign_student->grade_id = $request->grade;
                    $assign_student->year_id = $checkyear;
                    $assign_student->class_id = $request->class;
                    $assign_student->save();


                    $discount = new DiscountStudent();
                    $discount->assign_student_id = $assign_student->id; // we can use the latest assign_student id because of using db transaction
                    $discount->fee_category_id = '2'; // equavalent to id no 2 in fee categories table which is registration fee. because only registration fee have discount
                    $discount->discount = $request->discount;
                    $discount->save();  


                    $student_fee = StudentFee::all();

                    foreach($student_fee as $value){


                        $feeCategory = FeeCategoryAmount::where('student_fee_id', $value->id)->where('class_id', $request->class)->get();

                        foreach($feeCategory as $value1){

                            if($value1->student_fee_id =="2"){
                                $reg_discount = $request->discount;
                            }
                            else{
                             $reg_discount = "0";   
                            }

                            $payment = new StudentPayment();
                            $payment->student_id = $user->id;
                            $payment->fee_category_id = $value1->student_fee_id;
                            $payment->grade_id = $request->grade;
                            $payment->class_id = $request->class;
                            $payment->discount = $reg_discount;
                            $payment->amount = $value1->amount;
                            $payment->save();  
                        }//2nd foreach
                        

                    }//1st foreach


            }); // end db transaction

        $notification = array(
            'message' => 'Student Registration Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.registration.view')->with($notification);
        
        }// end method



        public function StudentGradeClassSearch(Request $request){

            //tips if you are using 2 methods in one blade make sure all the variables from two methods have same name to avoid errors. the best way of this just copy all the variable from first method who use in the blade and paste it in the second method 

            $data['class'] = StudentClass::all();
            $data['grade'] = StudentGrade::all();

            $data['grade_id'] = $request->grade;
            $data['class_id'] = $request->class;

            $data['alldata'] = AssignStudent::where('grade_id',$request->grade)->where('class_id',$request->class)->get();
           // dd($data['alldata']->toArray());
            return view('backend.student.student_reg.student_view', $data);
        }


        public function StudentRegistrationEdit($student_id){
            $data['class'] = StudentClass::all();
            $data['year'] = StudentYear::all();
            $data['grades'] = StudentGrade::all();

             // i use the with function here to be able to edit the other table make sure the assignstudent have relation to the table you want to edit                               
            $data['editData'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();

            //dd($data['editData']->toArray());  try this code it might help you to see the exact value of the table
            return view('backend.student.student_reg.student_edit', $data);

        }


        public function StudentRegistrationUpdate(Request $request, $student_id){

           // use db transaction for inserting multiple table. the usage of this is you can get the latest data that inserted and use it to other table. dont forget to declare the db at the top to use this
                DB::transaction(function() use($request, $student_id){ 

                    $user = User::where('id',$student_id)->first();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->mothers_name = $request->mothers_name;
                    $user->fathers_name = $request->fathers_name;
                    $user->mobile_number = $request->mobile_number;
                    $user->address = $request->address;
                    $user->gender = $request->gender;
                    $user->religion = $request->religion;
                    $user->dob = date('Y-m-d',strtotime($request->dob));
                    $user->gender = $request->gender;

                    if($request->file('image')){  // if there's an image
                        $file= $request->file('image'); // store the image in the variable
                         @unlink(public_path('upload/student_images/'.$user->image)); //delete the previous image
                        $filename = date('YmdHi').$file->getClientOriginalName(); // make own name of the images
                        $file->move(public_path('upload/student_images'),$filename); //location of the storage
                        $user['image'] = $filename;                        
                    }
                    $user->save();

                    $assign_student = AssignStudent::where('student_id',$student_id)->first();
                    $assign_student->year_id = $request->year;
                    $assign_student->class_id = $request->class;
                    $assign_student->grade_id = $request->grade;
                    $assign_student->save();


                    $discount = DiscountStudent::where('assign_student_id',$request->assign_student_id)->first(); 
                    $discount->discount = $request->discount;
                    $discount->save();       

            }); // end db transaction

        $notification = array(
            'message' => 'Student Updated Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.registration.view')->with($notification);
        
        }// end method





    public function StudentRegistrationDetails($student_id){


          $data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();

           $pdf = PDF::loadView('backend.student.student_reg.student_detail', $data);
            
           return $pdf->download('pdf_file.pdf');

                
    }

}
