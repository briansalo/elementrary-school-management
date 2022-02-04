<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFee;
use App\Models\FeeCategoryAmount;

class StudentFeeController extends Controller
{
        public function ViewFeeStudent(){
        $alldata = StudentFee::all();
        return view('backend.setup.studentfee.view_fee', compact('alldata'));
    }

        public function AddFeeStudent(){
        return view('backend.setup.studentfee.add_fee');
    }

        public function StoreFeeStudent(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_fees,name',
            
        ]);

        $data = new StudentFee();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Fee Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.fee.view')->with($notification);

        }

        public function EditFeeStudent($id){
        $editData = StudentFee::find($id);
        return view('backend.setup.studentfee.edit_fee', compact('editData'));
        }


        public function UpdateFeeStudent(Request $request, $id){
        $data = StudentFee::Find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student Fee Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.fee.view')->with($notification);
        }

        public function DeleteFeeStudent($id){

        $data = FeeCategoryAmount::where('student_fee_id', $id)->first();
        if($data == null){
             $user = StudentFee::find($id);
            $user->delete();
        }else{
             $user = StudentFee::find($id);
            $user->delete();
            $data->delete();
        }




        

        $notification = array(
            'message' => 'Student Fee Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('student.fee.view')->with($notification);
        }






}
