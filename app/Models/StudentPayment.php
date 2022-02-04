<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    
        public function student(){
        return $this->belongsTo(User::class,'student_id','id'); // it means the studentpayment table, in the student_id connected to the id of user table
    }


    public function student_year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');// it means the studentpayment table, in the year_id connected to the id of studentyear table
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');// it means the studentpayment table, in the year_id connected to the id of studentyear table
    }


}
