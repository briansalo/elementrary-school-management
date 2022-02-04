<?php

namespace App\Http\Controllers\backend\class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AssignEmployee;
use App\Models\AssignGrade;
use App\Models\AssignClass;

use App\Models\ClassStudentGrade;

use Auth;

class ClassStudentGradeController extends Controller
{
 public function ClassStudentGradeSearch(){

            $data['teacher'] = AssignClass::select('employee_id')->groupBy('employee_id')->get();

        return view('backend.class.class_student_grade.class_student_grade_search', $data);

 }
 public function ClassStudentGradeView(Request $request){
   // dd($request->select_name);

       $data['teacher'] = AssignClass::select('employee_id')->groupBy('employee_id')->get();


        $employee = AssignEmployee::where('employee_id', $request->select_name)->first();
        $data['subjects'] = AssignGrade::where('grade_id', $employee->grade_id)->where('class_id', $employee->class_id)->get();

        $data['students'] = AssignClass::where('employee_id', $request->select_name)->get();

          // this will retrieve the grade in every student by grading
        $first = [];
        $second = [];
        $third = [];
        $fourth = [];
        foreach($data['students'] as $row){
             $first[] = ClassStudentGrade::where('student_id', $row->student_id)->where('grading','1')->get();
             $second[] = ClassStudentGrade::where('student_id', $row->student_id)->where('grading','2')->get();
             $third[] = ClassStudentGrade::where('student_id', $row->student_id)->where('grading','3')->get();
             $fourth[] = ClassStudentGrade::where('student_id', $row->student_id)->where('grading','4')->get();
        }

/////////////////////////////////////////////////computation for the final grades////////////////////////////////////
       $final_grade=[];
       $general_average=[];

      $get_student = ClassStudentGrade::select('student_id')
      ->groupBy('student_id')
      ->where('employee_id', $request->select_name)
      ->orderBy('created_at','ASC')
      ->get();
     foreach($get_student as $row){

          $get_grade=[];
               //get all the subject for this grade and class
           foreach($data['subjects'] as $row_three){    
                 $get_subject =$row_three->school_subject->name;

                     $student_subject= ClassStudentGrade::where('student_id', $row->student_id)->where('subject',$get_subject)->get();

                     $grade=[];
                     //get the grade for the specific subject
                     foreach($student_subject as $value){
                         $grade[] = $value->grade;
                     }
                   //add all the grade from first grading to 4th grading. then divide it to four
                 $get_grade[] = array_sum($grade)/4;

               }
               //collect method will help to group all grades of the student for in every subject
               // since our table in front-end in final grade is we need to put/show the grade of every student in horizontal
               //check it out also in $general_average variable. i write some comment at the top for comparison.
               // for more details try to dd this final_grade variable and also look at the scenario in blade. 
               $final_grade[] = collect($get_grade);

               // i didn't use collect method here because in front-end in final grade we only need 1 column to put this data
               //get the general average of the student and divide it in how many subject
               $general_average[] = array_sum($get_grade)/count($data['subjects']);

     }


        return view('backend.class.class_student_grade.class_student_grade_view', $data)
        ->with(compact('employee','first','second','third','fourth','final_grade','general_average'));
 }







 public function ClassStudentGradingStore(Request $request){


       if($request->has('1st_grading')){
 
            $student = ClassStudentGrade::where('grading','1')->get();
            //check if this $student variable is not empty then delete it first all the record before save new data
             if(!$student->isEmpty()){
                  ClassStudentGrade::where('grading', '1')->where('employee_id', $request->employee)->delete();
             }


            for($i=0; $i<count($request->student); $i++){
                  for($x=0; $x<count($request->subject0); $x++){

                       $get_grade = 'grade'.$i;
                       $get_subject = 'subject'.$i;
                     
                        $new = new ClassStudentGrade();
                        $new->employee_id = $request->employee;
                        $new->student_id = $request->student[$i];
                        $new->grade = $request->$get_grade[$x];
                        $new->grading = '1';
                        $new->subject = $request->$get_subject[$x];
                        $new->save(); 

                  }// end $x loop
            }// end $i loop
             
            return back();
       }// end if 1st grading


       if($request->has('2nd_grading')){

            $student = ClassStudentGrade::where('grading','2')->get();
            //check if this $student variable is not empty then delete it first all the record before save new data
             if(!$student->isEmpty()){
                  ClassStudentGrade::where('grading', '2')->where('employee_id', $request->employee)->delete();
             }            

            for($i=0; $i<count($request->student); $i++){
                  for($x=0; $x<count($request->subject0); $x++){

                       $get_grade = 'grade'.$i;
                       $get_subject = 'subject'.$i;
                     
                        $new = new ClassStudentGrade();
                        $new->employee_id = $request->employee;
                        $new->student_id = $request->student[$i];
                        $new->grade = $request->$get_grade[$x];
                        $new->grading = '2';
                        $new->subject = $request->$get_subject[$x];
                        $new->save(); 

                  }// end $x loop
            }// end $i loop

            return back();
       }// end if 2nd grading


       if($request->has('3rd_grading')){

            $student = ClassStudentGrade::where('grading','3')->get();
            //check if this $student variable is not empty then delete it first all the record before save new data
             if(!$student->isEmpty()){
                  ClassStudentGrade::where('grading', '3')->where('employee_id', $request->employee)->delete();
             }            

            for($i=0; $i<count($request->student); $i++){
                  for($x=0; $x<count($request->subject0); $x++){

                       $get_grade = 'grade'.$i;
                       $get_subject = 'subject'.$i;
                     
                        $new = new ClassStudentGrade();
                        $new->employee_id = $request->employee;
                        $new->student_id = $request->student[$i];
                        $new->grade = $request->$get_grade[$x];
                        $new->grading = '3';
                        $new->subject = $request->$get_subject[$x];
                        $new->save(); 

                  }// end $x loop
            }// end $i loop

            return back();
       }// end if 3rd grading



       if($request->has('4th_grading')){

            $student = ClassStudentGrade::where('grading','4')->get();
            //check if this $student variable is not empty then delete it first all the record before save new data
             if(!$student->isEmpty()){
                  ClassStudentGrade::where('grading', '4')->where('employee_id', $request->employee)->delete();
             }            

            for($i=0; $i<count($request->student); $i++){
                  for($x=0; $x<count($request->subject0); $x++){

                       $get_grade = 'grade'.$i;
                       $get_subject = 'subject'.$i;
                     
                        $new = new ClassStudentGrade();
                        $new->employee_id = $request->employee;
                        $new->student_id = $request->student[$i];
                        $new->grade = $request->$get_grade[$x];
                        $new->grading = '4';
                        $new->subject = $request->$get_subject[$x];
                        $new->save(); 

                  }// end $x loop
            }// end $i loop

            return back();
       }// end if 4th grading


 }




public function ClassStudentGradeAdminView(){

        return view('backend.class.class_student_grade.class_student_grade_admin_view');
}


}//end of class controller

