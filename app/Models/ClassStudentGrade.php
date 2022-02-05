<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudentGrade extends Model
{

    public function school_subject(){
        return $this->belongsTo(SchoolSubject::class, 'subject','id');

    }
}
