<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentGrade;

class StudentGradeController extends Controller
{

        public function ViewGradeStudent(){
        $alldata = StudentGrade::all();
        return view('backend.setup.student_grade.view_grade', compact('alldata'));

    }

        public function AddGradeStudent(){
            return view('backend.setup.student_grade.add_grade');

        }


        public function StoreGradeStudent(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_grades,name', // the student_grades came from sql table 
            
        ]);

        $data = new StudentGrade();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Grade Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.grade.view')->with($notification);

        }
}
