<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'subject', 'monthly_marks', 'mid_term_marks', 'final_marks'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
