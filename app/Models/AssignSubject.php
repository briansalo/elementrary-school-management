<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id','id');// it means the assignsubject table, in the class_id connected to the id of studentclass table

    }

    public function school_subject(){
        return $this->belongsTo(SchoolSubject::class, 'subject_id','id');

    }


}
