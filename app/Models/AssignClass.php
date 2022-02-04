<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    

}
