<?php

namespace App\Http\Controllers\backend\setup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentYear;

class StudentYearController extends Controller
{
        public function ViewYearStudent(){
        $alldata = StudentYear::all();
        return view('backend.setup.studentyear.view_year', compact('alldata'));

    }

        public function AddYearStudent(){
            return view('backend.setup.studentyear.add_year');

        }

        public function StoreYearStudent(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name', // the student_years came from sql table 
            
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.year.view')->with($notification);

        }

        public function EditYearStudent($id){

        $editData = StudentYear::find($id);
        return view('backend.setup.studentyear.edit_year', compact('editData'));

        }

        public function UpdateYearStudent(Request $request, $id){
        $data = StudentYear::Find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.year.view')->with($notification);
        }


        public function DeleteYearStudent($id){
        $user = StudentYear::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Year Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.year.view')->with($notification);
        }

}
