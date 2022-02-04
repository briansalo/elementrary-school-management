<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    public function student_fee(){
        return $this->belongsTo(StudentFee::class, 'student_fee_id','id');

    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id','id');

    }

}
