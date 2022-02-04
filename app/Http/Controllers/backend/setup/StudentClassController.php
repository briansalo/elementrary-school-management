<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewStudent(){
        $alldata = StudentClass::all();
        return view('backend.setup.studentclass.view_class', compact('alldata'));

    }

    public function StudentClassAdd(){
        return view('backend.setup.studentclass.add_class');
    }

    public function StudentClassStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name',
            
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.class.view')->with($notification);

    }

    public function StudentClassEdit($id){
        $editData = StudentClass::find($id);
        return view('backend.setup.studentclass.edit_class', compact('editData'));
    }

    public function StudentClassUpdate(Request $request, $id){

        $data = StudentClass::Find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    public function StudentClassDelete($id){

        $user = StudentClass::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Student Class Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.class.view')->with($notification);

    }
}
