<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AssignGrade;
use App\Models\ClassStudentGrade;

use DB;

class AssignClass extends Model
{
    public function student(){
        return $this->belongsTo(User::class,'student_id','id'); // it means the assignstudent table, in the student_id connected to the id of user table
    }

        public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id'); // it means the assignstudent table, in the class_id connected to the id of studenclass table
    }


    public function student_grade(){
        return $this->belongsTo(StudentGrade::class,'grade_id','id');
    }

    public function employee(){
        return $this->belongsTo(User::class,'employee_id','id');
    }
    

    public function checkgrade(){

        //check if what are the subject of every student 
        $student = ClassStudentGrade::select('subject')->groupBy('subject')->where('student_id', $this->student_id)->get();

        //get the pass_mark of every subject
        $array=[];
        foreach($student as $row){
            $array[]= DB::table('assign_grades')->where('grade_id',$this->grade_id)
            ->where('class_id', $this->class_id)
            ->where('subject_id',$row->subject)
            ->first()->pass_mark;
        }

        return $array;
        
    }
}
