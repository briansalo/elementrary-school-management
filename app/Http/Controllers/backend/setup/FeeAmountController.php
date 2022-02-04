<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentFee;


class FeeAmountController extends Controller
{

        public function ViewCategoryAmount(){
        $data['alldata'] = FeeCategoryAmount::select('student_fee_id')->groupBy('student_fee_id')->get();
        
        return view('backend.setup.fee_amount.view_fee_amount',$data);
    }


    public function AddFeeAmount(Request $request){

        $countClass= count($request->class);
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->student_fee_id = $request->fee;
                $fee_amount->class_id = $request->class[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }//end for loop
        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('category.amount.view')->with($notification);


    } //end method


    public function EditFeeAmount($id){
        $data['editdata'] = FeeCategoryAmount::where('student_fee_id', $id)->orderBy('class_id','asc')->get();
       $data['fee_categories'] = StudentFee::where('id', $id)->get();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount',$data);                

    }


    public function UpdateFeeAmount(Request $request, $student_fee_id){

       if($request->class == !NULL){ 
        $countClass= count($request->class);
        FeeCategoryAmount::where('student_fee_id', $student_fee_id)->delete(); // we need to delete the previous data because we can't update if where basing the feecategoryamount id. remember we need to update the student_fee_id not the feecategoryamount id
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->student_fee_id = $request->fee;
                $fee_amount->class_id = $request->class[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }//end for loop
        $notification = array(
            'message' => 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('category.amount.view')->with($notification);


        }else{

        $notification = array(
            'message' => 'Class Category is empty',
            'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('fee.amount.edit',$student_fee_id )->with($notification);  

        }//end else

    } //end method


    public function DetailsFeeAmount($id){
        
        $checkdata = FeeCategoryAmount::where('student_fee_id', $id)->get();
        if($checkdata->isEmpty()){

        $notification = array(
            'message' => 'The Class is empty Please add some class',
            'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('add.fee.amount', $id)->with($notification);  
        
        }
        else{
        $data['detailsdata'] = FeeCategoryAmount::where('student_fee_id', $id)->orderBy('class_id','asc')->get();

        return view('backend.setup.fee_amount.details_fee_amount',$data);

        }

             

    }






}



