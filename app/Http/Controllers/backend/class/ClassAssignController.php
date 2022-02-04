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
           $data['alldata'] = AssignStudent::whereNotIn('student_id',$assign_class)->get();

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
                    'message' => 'No Available Student for this',
                    'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
                );
                return redirect()->route('class.assign.view')->with($notification);

        }else{;
        return view('backend.class.class_assign.class_assign_add', $data);
        }
        
    }


public function ClassAssignStore(Request $request){

    for($i=0; $i<count($request->check_student); $i++){

            //in assignstudent table. update the class_status of the student to no. 1. it means the student already had teachers
        AssignStudent::where('student_id', $request->check_student[$i])->update(['class_status' => 1]);

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

    
    AssignClass::where('student_id',$student)->delete();

    //in assignstudent table. update the class_status of student to zero. it means the student has no teacher
    AssignStudent::where('student_id', $student)->update(['class_status' => 0]);

        $notification = array(
            'message' => 'Student Remove Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('class.assign.list', $employee)->with($notification);
}


}
