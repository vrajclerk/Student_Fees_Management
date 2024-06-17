<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Mark;
use PDF;

class MarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // private $subjects = [
    //     'Account',
    //     'Economics',
    //     'Statastics',
    //     'B.A.',
    //     'English',
    //     'Gujarati',
    //     'Computer'
    // ];

    public function index(Student $student)
    {
        $marks = $student->marks;
        return view('marks.index', compact('student', 'marks'));
    }

    public function create(Student $student)
    {
        $subjects = ['Account', 'Economics', 'Statastics','B.A.', 'English','Gujarati','Computer'];
        return view('marks.create', compact('student', 'subjects'));
    }

    public function store(Request $request, Student $student)
    {
        $request->validate([
            'marks.*.subject' => 'required|string',
            'marks.*.monthly_marks' => 'nullable|integer',
            'marks.*.mid_term_marks' => 'nullable|integer',
            'marks.*.final_marks' => 'nullable|integer',
        ]);

        foreach ($request->marks as $markData) {
            $mark = new Mark([
                'subject' => $markData['subject'],
                'monthly_marks' => $markData['monthly_marks'],
                'mid_term_marks' => $markData['mid_term_marks'],
                'final_marks' => $markData['final_marks'],
            ]);
            $student->marks()->save($mark);
        }

        return redirect()->route('students.marks.index', $student->id)->with('success', 'Marks added successfully.');
    }


    public function edit(Student $student)
    {
        $mark = $student->marks; // Retrieve all marks associated with the student
        return view('marks.edit', compact('student', 'mark'));
    }
    

    public function update(Request $request, Student $student, Mark $mark)
{
    $request->validate([
        'marks.*.id' => 'required|integer|exists:marks,id',
        'marks.*.monthly_marks' => 'nullable|integer',
        'marks.*.mid_term_marks' => 'nullable|integer',
        'marks.*.final_marks' => 'nullable|integer',
    ]);

    foreach ($request->marks as $markData) {
        $markToUpdate = Mark::findOrFail($markData['id']);
        $markToUpdate->update([
            'monthly_marks' => $markData['monthly_marks'],
            'mid_term_marks' => $markData['mid_term_marks'],
            'final_marks' => $markData['final_marks'],
        ]);
    }

    return redirect()->route('students.marks.index', $student)->with('success', 'Marks updated successfully.');
}


    public function destroy(Student $student, Mark $mark)
    {
        $mark->delete();

        return redirect()->route('students.marks.index', $student)->with('success', 'Marks deleted successfully.');
    }
    public function download()
{
    $marks = Mark::with('student')->get(); // Eager load students with their marks

    $filename = "student_marks.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['Roll Number', 'Name', 'Subject', 'Monthly Marks', 'Mid Term Marks', 'Final Marks']);

    foreach ($marks as $mark) {
        fputcsv($handle, [
            $mark->student->roll_no,
            $mark->student->name,
            $mark->subject,
            $mark->monthly_marks,
            $mark->mid_term_marks,
            $mark->final_marks
        ]);
    }

    fclose($handle);

    $headers = [
        'Content-Type' => 'text/csv',
    ];

    return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
}

}
