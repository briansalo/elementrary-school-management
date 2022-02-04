<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignGrade;
use App\Models\StudentClass;
use App\Models\SchoolSubject;
use App\Models\StudentGrade;

class AssignGradeController extends Controller
{

    public function ViewAssignGrade(){

        $data['alldata'] = StudentGrade::all();
        return view('backend.setup.assign_grade.view_assign_grade', $data);

    }

    public function AddAssignGrade($grade){
        $data['grade'] = StudentGrade::find($grade);
        $data['subjects'] = SchoolSubject::all();

  ///////////////////// this process is to show only the class name that not been use in the grade/////////////////
            $value = [];
        $data['collect'] = AssignGrade::where('grade_id', $grade)->get();
        foreach($data['collect'] as $row){
          $value[] = $row->class_id;
        }
        $data['classes'] = StudentClass::whereNotIn('id', $value)->get();

        return view('backend.setup.assign_grade.add_assign_grade', $data);
    }


    public function StoreAssignGrade(Request $request){
    
        $countSubject= count($request->subject);
            for ($i=0; $i<$countSubject; $i++){
                $assign_grade = new AssignGrade();
                $assign_grade->grade_id = $request->grade;
                $assign_grade->class_id = $request->class;
                $assign_grade->subject_id = $request->subject[$i];
                $assign_grade->full_mark = $request->full_mark[$i];
                $assign_grade->pass_mark = $request->pass_mark[$i];
                $assign_grade->save();
            }//end for loop
        $notification = array(
            'message' => 'Assign Grade Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('assign.grade.view')->with($notification);


    } //end method


    public function DetailsAssignGrade($id){

        $data['grade'] = AssignGrade::where('grade_id', $id)->first();

            //check if the  grade i.d. that selected is null in assigngrade database
        if($data['grade'] == null){
            //i declare this $try variable to avoid error in blade 
            $try = "to avoid error";
            //this will determine if the grade_id is null or not. i make a if statement of this variable in blade
            $data['value'] = '1';

                //we will use this in add class button to get the i.d. of student grade
            $data['null_grade'] = StudentGrade::find($id);


            }else{

            //this will determine if the grade_id is null or not. i make a if statement of this variable in blade          
         $data['value'] = '0';
        
         $data['classes'] = AssignGrade::select('class_id','grade_id')
         ->groupBy('class_id','grade_id')
         ->where('grade_id', $id)
         ->get();

         $try = [];
            foreach($data['classes'] as $row){

                $try[] = AssignGrade::where('class_id', $row->class_id)
                ->where('grade_id', $row->grade_id)
                ->get();


                }//end for loop

            }//end else
        
        return view('backend.setup.assign_grade.details_assign_grade',$data)->with('try', $try);

    }


    public function EditAssignGradeSubject($class, $grade){

        $data['editdata'] = AssignGrade::where('class_id', $class)
        ->where('grade_id', $grade)
        ->orderBy('subject_id','asc')
        ->get();
       $data['classes'] = StudentClass::where('id', $class)->get();
        $data['subjects'] = SchoolSubject::all();
        return view('backend.setup.assign_grade.edit_subject_assign_grade',$data);                

    }



    public function UpdateAssignGradeSubject(Request $request, $class, $grade){


       if($request->subject == !NULL){ 
        $countSubject= count($request->subject);
        AssignGrade::where('class_id', $class)->where('grade_id', $grade)->delete(); // we need to delete the previous data because we can't update if where basing the assignsubject id. remember we need to update the class_id not the assignsubject id
            for ($i=0; $i<$countSubject; $i++){
                $assign_grade = new AssignGrade();
                $assign_grade->grade_id = $grade; 
                $assign_grade->class_id = $class;
                $assign_grade->subject_id = $request->subject[$i];
                $assign_grade->full_mark = $request->full_mark[$i];
                $assign_grade->pass_mark = $request->pass_mark[$i];
                $assign_grade->save();
            }//end for loop
        $notification = array(
            'message' => 'Assign Grade Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('assign.grade.details',$grade)->with($notification);


        }else{

        $notification = array(
            'message' => 'Class is empty',
            'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('assign.subject.edit',['class'=>$class, 'grade'=>$grade])->with($notification);  

        }//end else

    } //end method



}
