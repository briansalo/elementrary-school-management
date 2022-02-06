<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Designation;
use App\Models\EmployeeSallaryLog;
use App\Models\StudentGrade;
use App\Models\StudentClass;
use App\Models\AssignEmployee;
use App\Models\ClassStudentGrade;

use DB;
use PDF;

class EmployeeRegistrationController extends Controller
{
    public function EmployeeView(){

        $data['alldata'] = AssignEmployee::orderBy('id','desc')->get();
        //dd($data['alldata']);
        return view('backend.employee.employee_reg.employee_view', $data);
    }

    public function EmployeeAdd(){

        $data['grades'] = StudentGrade::all();
        $data['classes'] = StudentClass::all();
        $data['designation'] = Designation::all();

        return view('backend.employee.employee_reg.employee_add', $data);

    }

    public function EmployeeStore(Request $request){

            // use db transaction for inserting multiple table. the usage of this is you can get the latest data that inserted and use it to other table. dont forget to declare the db at the top to use this
            DB::transaction(function() use($request){ 


                    $user = new User();
                    $code = rand(0000,9999); // creating random password
                   // $user->id_no = $final_id;
                    $user->password = bcrypt($code);
                    $user->usertype = 'employee';
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
                    $user->designation_id = $request->designation;
                    $user->salary = $request->salary;

                    if($request->file('image')){  // if there's an image
                        $file= $request->file('image'); // store the image in the variable
                        $filename = date('YmdHi').$file->getClientOriginalName(); // make own name of the images
                        $file->move(public_path('upload/employee_images'),$filename); //location of the storage
                        $user['image'] = $filename;                        
                    }
                    $user->save();




                //................................... TO generate THE I.D. NO. OF THE Employee. 

                    $employee_id = User::where('id', $user->id)->first();

                        // to get only the year in created at 
                    $checkyear = date('Y',strtotime($employee_id->created_at));

                $employee = User::where('usertype','employee')->orderBy('id','DESC')->get();
                
                //this condition if theres one employee in usertype 
                if($employee->count() == '1'){
                    $id_no = 'E0001';
                }else{                    
                   $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;  
                   $employee_id = $employee+1; 
                
                     if($employee_id <10){
                            $id_no = 'E000'.$employee_id;
                    }elseif($employee_id  < 100){
                            $id_no = 'E00'.$employee_id;  
                     }elseif($employee_id < 1000){
                            $id_no = 'E0'.$employee_id;
                     }

                    }// end else

                    $final_id = $checkyear.$id_no;


                        // updating the employee id_no
                    $employee_id = User::where('id', $user->id)->first();            
                    $employee_id->id_no = $final_id;
                    $employee_id->save();



                    // inserting in assignemployee database
                    $assign_employee = new AssignEmployee();
                    $assign_employee->employee_id = $user->id;
                    $assign_employee->grade_id = $request->grade;
                    $assign_employee->class_id = $request->class;
                    $assign_employee->designation_id = $request->designation;
                    $assign_employee->save();

                    //.............................inserting data in employee_salary_logs table

                   // $employee_salary = new EmployeeSallaryLog();
                    //$employee_salary->employee_id = $user->id;
                    //$employee_salary->effective_salary = date('Y-m-d',strtotime($user->created_at));
                    //$employee_salary->previous_salary = $request->salary;
                    //$employee_salary->present_salary = $request->salary;
                    //$employee_salary->increment_salary = '0';
                    //$employee_salary->save();


            

            }); // end db transaction

        $notification = array(
            'message' => 'Student Registration Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.registration.view')->with($notification);
        
        }// end method



        public function EmployeeEditData($id){
            $data['class'] = StudentClass::all();
            $data['grades'] = StudentGrade::all();
            $data['designation'] = Designation::all();

            $data['editdata'] = AssignEmployee::where('employee_id',$id)->first();
        // dd($data['editdata']->id);
            return view('backend.employee.employee_reg.employee_edit', $data);
        }


        public function EmployeeUpdateData(Request $request, $employee_id){
            $check_employe = ClassStudentGrade::where('employee_id', $employee_id)->first();
            if(empty($check_employe)){
           // use db transaction for inserting multiple table. the usage of this is you can get the latest data that inserted and use it to other table. dont forget to declare the db at the top to use this
                DB::transaction(function() use($request, $employee_id){ 

                    $user = User::where('id',$employee_id)->first();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->mothers_name = $request->mothers_name;
                    $user->fathers_name = $request->fathers_name;
                    $user->mobile_number = $request->mobile_number;
                    $user->address = $request->address;
                    $user->gender = $request->gender;
                    $user->religion = $request->religion;
                    $user->dob = date('Y-m-d',strtotime($request->dob));
                    $user->designation_id = $request->designation;

                    if($request->file('image')){  // if there's an image
                        $file= $request->file('image'); // store the image in the variable
                         @unlink(public_path('upload/employee_images/'.$user->image)); //delete the previous image
                        $filename = date('YmdHi').$file->getClientOriginalName(); // make own name of the images
                        $file->move(public_path('upload/employee_images'),$filename); //location of the storage
                        $user['image'] = $filename;                        
                    }
                    $user->save();

                    $assign_employee = AssignEmployee::where('employee_id',$employee_id)->first();
                    $assign_employee->class_id = $request->class;
                    $assign_employee->grade_id = $request->grade;
                    $assign_employee->designation_id = $request->designation;
                    $assign_employee->save();
    
                 }); // end db transaction

                    $notification = array(
                        'message' => 'Employee Updated Successfully',
                        'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
                    );

            }else{

                $notification = array(
                    'message' => 'This employee had already grades for their student, we cant update this employee now',
                    'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
                );
            }


        return redirect()->route('employee.registration.view')->with($notification);
        
        }// end method


        public function EmployeeRegistrationPdf($id){

          $data['details'] = AssignEmployee::where('employee_id',$id)->first();
          //dd($data['details']->designation_id);

          return view('backend.employee.employee_reg.employee_pdf', $data);

              $pdf = PDF::loadView('backend.student.employee_reg.employee_pdf', $data);
              
                return $pdf->download('pdf_file.pdf');

        }

} // end class
