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

        return $query->orderBy('roll_no', 'asc')->paginate(5);
    }   
}
