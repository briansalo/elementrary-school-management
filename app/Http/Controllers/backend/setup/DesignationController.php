<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function ViewDesignation(){
        $alldata = Designation::all();
        return view('backend.setup.designation.view_designation', compact('alldata'));

    }

    public function AddDesignation(){
        return view('backend.setup.designation.add_designation');

    }

    public function StoreDesignation(Request $request){


        $validatedData = $request->validate([
            'name' => 'required|unique:designations,name',
            
        ]);

        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Add Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('designation.view')->with($notification);

    }


    public function EditDesignation($id){
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));

    }

    public function UpdateDesignation(Request $request, $id){
        $data = Designation::Find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('designation.view')->with($notification);

    }

        public function DeleteDesignation($id){
        $user = Designation::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Designation Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('designation.view')->with($notification);
        }



}
