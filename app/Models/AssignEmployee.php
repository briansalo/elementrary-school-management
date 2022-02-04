<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignEmployee extends Model
{
    public function employee(){
        return $this->belongsTo(User::class,'employee_id','id'); 
    }

        public function employee_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function employee_grade(){
        return $this->belongsTo(StudentGrade::class,'grade_id','id');
    }
    public function employee_designation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }


}
