<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id', 'account', 'statistics', 'total', 'percentage', 'grade'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
