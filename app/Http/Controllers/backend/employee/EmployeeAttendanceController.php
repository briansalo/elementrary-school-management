<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Designation;
use App\Models\EmployeeAttendance;

use DB;


class EmployeeAttendanceController extends Controller
{
    public function EmployeeAttendanceView(){
    
    
        $data = EmployeeAttendance::select('date')
        ->addSelect('status')
        ->groupBy('date', 'status')
        ->orderBy('date', 'DESC')->get();

        return view('backend.employee.employee_attendance.employee_attendance_view')->with('data',$data);

    }

    public function EmployeeAttendanceAdd(){

        $data['employees'] = User::where('usertype', 'employee')->get();

        return view('backend.employee.employee_attendance.employee_attendance_add', $data);        

    }


    public function EmployeeAttendanceStore(Request $request){

        $validatedData = $request->validate([
            'date' => 'required|unique:employee_attendances,date', // the employee_attendances came from sql table
        ]);

        
        $countemployee = count($request->employee_id);

        for($i=0; $i <$countemployee; $i++){

                // i make a stringfirst that same name in request attendance_status then i add the number of loop in able to read as = attendance_status(then the number)) to get the same name in blade of this
            $get_attendance_status = 'attendance_status'.$i;
            $get_late = 'late'.$i;
            $get_overtime = 'overtime'.$i;

            $attendance = new EmployeeAttendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->attendance_status = $request->$get_attendance_status;
            $attendance->late = $request->$get_late;
            $attendance->overtime = $request->$get_overtime;
            $attendance->save();
        }//end for loop
    

        $notification = array(
            'message' => 'Attendance Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.attendance.view')->with($notification);

    }


    public function EmployeeAttendanceEdit($date){

        $data['editdata'] = EmployeeAttendance::where('date', $date)->get();

        return view('backend.employee.employee_attendance.employee_attendance_edit', $data);         

    }



    public function EmployeeAttendanceUpdate(Request $request){

            // delete all attendance in request date and insert new value
        EmployeeAttendance::where('date', $request->date)->delete();

        $countemployee = count($request->employee_id);

        for($i=0; $i <$countemployee; $i++){

                // i make a stringfirst that same name in request then i add the number of loop in able to read as = attendance_status(then the number)) to get the same name in blade of this
            $get_attendance_status = 'attendance_status'.$i;
            $get_late = 'late'.$i;
            $get_overtime = 'overtime'.$i;
           
            $attendance = new EmployeeAttendance();
            $attendance->employee_id = $request->employee_id[$i];
            $attendance->date = date('Y-m-d', strtotime($request->date));
            $attendance->attendance_status = $request->$get_attendance_status;
            $attendance->late = $request->$get_late;
            $attendance->overtime = $request->$get_overtime;
            $attendance->save();
        }//end for loop

        $notification = array(
            'message' => 'Attendance Updated Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.attendance.view')->with($notification);

    }


    public function EmployeeAttendanceDelete($date){

            EmployeeAttendance::where('date', $date)->delete();

        $notification = array(
            'message' => 'Attendance Deleted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('employee.attendance.view')->with($notification);

    }



    public function EmployeeAttendanceDetails($date){

        $data['detail'] = EmployeeAttendance::where('date', $date)->get();        

        return view('backend.employee.employee_attendance.employee_attendance_detail', $data);
    }

}
