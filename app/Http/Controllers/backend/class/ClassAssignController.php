<?php

namespace App\Http\Controllers\backend\class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentGrade;
use App\Models\StudentClass;
use App\Models\User;
use App\Models\AssignEmployee;
use App\Models\AssignStudent;
use App\Models\AssignClass;
use App\Models\ClassStudentGrade;


class ClassAssignController extends Controller
{


    public function ClassAssignView(){

        //check if the teacher and student is having same grade and class
        $check_class = AssignClass::all();
        foreach($check_class as $row){
             $get_employee = AssignEmployee::where('employee_id', $row->employee_id)->first();
             $get_student = AssignStudent::where('student_id', $row->student_id)->first();
             if($get_employee->grade_id != $get_student->grade_id or $get_employee->class_id != $get_student->class_id){
                 AssignClass::where('employee_id',$row->employee_id)->where('student_id', $row->student_id)->delete();
             }

        }

        $alldata = AssignEmployee::all();

        // to count how many student for each employee
            $no_of_student = [];
            foreach($alldata as $row){
                $data = AssignClass::where('employee_id', $row->employee_id)->get();
                $no_of_student[] = count($data);
            }

            //to get all the available students
            $assign_class = AssignClass::all()->pluck('student_id');             
           $available_student = AssignStudent::whereNotIn('student_id',$assign_class)->get();

        return view('backend.class.class_assign.class_assign_view')->with(compact('no_of_student','alldata','available_student'));

    }

    public function ClassAssignStudentAvailable(){

            //to get all the available students
            $assign_class = AssignClass::all()->pluck('student_id');             
           $data['alldata'] = AssignStudent::whereNotIn('student_id',$assign_class)->where('class_status','0')->get();

           return view('backend.class.class_assign.class_assign_student_available', $data);

}
    
    public function ClassAssignAdd($id){

        $data['employee'] = AssignEmployee::where('employee_id', $id)->first();
                
        // get the student for those have same class_id and grade_id of the employee       
        $data['alldata'] = AssignStudent::where('class_id', $data['employee']->class_id)
        ->where('grade_id', $data['employee']->grade_id)
        ->where('class_status', '0')
        ->get();
        
        if($data['alldata']->isEmpty()){

                $notification = array(
                    'message' => 'There is no available student for this',
                    'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
                );
                return redirect()->route('class.assign.view')->with($notification);

        }else{;
        return view('backend.class.class_assign.class_assign_add', $data);
        }
        
    }


public function ClassAssignStore(Request $request){



    for($i=0; $i<count($request->check_student); $i++){

        AssignStudent::where('student_id', $request->check_student[$i])->update(['class_status' => 1]);

        ClassStudentGrade::where('student_id',$request->check_student[$i])->update(['employee_id'=> $request->employee_id]);

        $new = new AssignClass();
        $new->employee_id = $request->employee_id;
        $new->student_id = $request->check_student[$i];
        $new->grade_id = $request->grade_id;
        $new->class_id = $request->class_id;      
        $new->save();
      }  

        $notification = array(
            'message' => 'Students Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('class.assign.view')->with($notification);

}


public function ClassAssignList($id){

           $data['employee'] = AssignEmployee::where('employee_id', $id)->first();

           $data['alldata'] = AssignClass::where('employee_id', $id)->get();

           //only students has not yet data in classstudentgrade database can remove
            $check_student=[];
            foreach($data['alldata'] as $row){
                $check_student[] =ClassStudentGrade::where('student_id',$row->student_id)->get();
            }
           return view('backend.class.class_assign.class_assign_list', $data)->with(compact('check_student'));

}



public function ClassAssignListRemove($student, $employee){

    $check_student = ClassStudentGrade::where('student_id', $student)->first();

    if(!empty($check_student)){
    //in assignstudent table. update the class_status of student to zero. it means the student has no teacher
         AssignStudent::where('student_id', $student)->update(['class_status' => 0]);   
    }

        AssignClass::where('student_id', $student)->delete();

        $notification = array(
            'message' => 'Student Remove Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('class.assign.list', $employee)->with($notification);
}


}
