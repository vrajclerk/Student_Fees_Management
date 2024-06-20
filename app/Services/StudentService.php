<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function filterStudentsByPaymentStatus($paymentStatus)
    {
        $query = Student::query();

        if ($paymentStatus) {
            if ($paymentStatus == 'fully_paid') {
                $query->where('remaining_fees', 0);
            } elseif ($paymentStatus == 'partially_paid') {
                //$query ->whereColumn('remaining_fees', '>', 0);
                $query  ->whereColumn('fees_paid', '<', 'total_fees');
            } elseif ($paymentStatus == 'not_paid') {
                $query->whereColumn('remaining_fees', 'total_fees');
            }
        }

        return $query->paginate(5);
    }   
    public function filterStudentsByclass($class)
    {
        $query1 = Student::query();

        if ($class) {
            if ($class == '11_Morning') {
            
                $query1->where('class', '11_Morning');
            } elseif ($class == '11_evening') {
                $query1->where('class' ,'11_evening');
            } elseif ($class == '12_Morning') {
                $query1->where('class' ,'12_Morning');
            } elseif ($class == '12_evening') {
                $query1->where('class' ,'12_evening');
        }

        return $query1->paginate(5);
    }   
}
}