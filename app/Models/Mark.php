<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'subject',
        'exam_type',
        'marks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
