<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class Student extends Model
{
    use HasFactory;
    // use SoftDeletes;

    //array defines attributes that can be mass-assigned
    protected $fillable = [
        'roll_no', 'name', 'total_fees', 'fees_paid', 'date','date1','date2'
    ];
    protected $appends = ['remaining_fees', 'payment_status'];

    public function getRemainingFeesAttribute()
    {
        return $this->total_fees - $this->fees_paid;
    }
    // defines payment status attribute
    public function getPaymentStatusAttribute()
    {
        if ($this->remaining_fees == 0) {
            return 'Fully Paid';
        } elseif ($this->fees_paid == 0) {
            return 'Not Paid';
        } else {
            return 'Partially Paid';
}
    }

    // protected $dates = ['date','date1','date2'];
    
    // public function getDateAttribute($value){
    //     $this->attributes['date'] = strtotime($value);
    //     $this->attributes['date1']=strtotime($value);
    //     $this->attributes['date2']=strtotime($value);
    // }

    public function marks()
{
    return $this->hasMany(Mark::class);
}
public function boardMarks()
{
    return $this->hasMany(BoardMark::class);
}
}
