<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'roll_no', 'name', 'total_fees', 'fees_paid', 'date'
    ];
    // protected $dates = ['date'];
    
    // public function getDateAttribute($value){
    //     $this->attributes['date'] = strtotime($value);
    // }
}
