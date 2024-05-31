<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'roll_no' => 'required|unique:students',
            'name' => 'required',
            'total_fees' => 'required|numeric',
            'fees_paid' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'roll_no' => 'required|unique:students,roll_no,' . $student->id,
            'name' => 'required',
            'additional_fees' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $student->fees_paid += $request->additional_fees;
        $student->save();

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function search(Request $request)
    {
        $roll_no = $request->input('search_roll_no');
        $students = Student::where('roll_no', $roll_no)->get();

        if ($students->isEmpty()) {
            return redirect()->route('students.index')->with('error', 'No records found with Roll Number: ' . $roll_no);
        }

        return view('students.index', compact('students'));
    }

    public function download()
    {
        $students = Student::all();

        $filename = "student_records.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Roll Number', 'Name', 'Total Fees', 'Fees Paid', 'Remaining Fees', 'Date']);

        foreach ($students as $student) {
            fputcsv($handle, [
                $student->id,
                $student->roll_no,
                $student->name,
                $student->total_fees,
                $student->fees_paid,
                $student->remaining_fees,
                $student->date
            ]);
        }

        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
}
