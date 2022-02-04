<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject(){
        $alldata = SchoolSubject::all();
        return view('backend.setup.school_subject.view_schoolsubject', compact('alldata'));

    }

    public function AddSchoolSubject(){
        return view('backend.setup.school_subject.add_schoolsubject');

    }


    public function StoreSchoolSubject(Request $request){


        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
            
        ]);

        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('school.subject.view')->with($notification);

    }

    public function EditSchoolSubject($id){
        $editData = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_schoolsubject', compact('editData'));

    }

    public function UpdateSchoolSubject(Request $request, $id){
        $data = SchoolSubject::Find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('school.subject.view')->with($notification);

    }

        public function DeleteSchoolSubject($id){
        $user = SchoolSubject::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('school.subject.view')->with($notification);
        }




}
