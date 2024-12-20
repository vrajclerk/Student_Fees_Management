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
        // Validates the input data using rules for each fieldc
        $request->validate([
            'marks.*.subject' => 'required|string',
            'marks.*.monthly_marks' => 'nullable|integer',
            'marks.*.mid_term_marks' => 'nullable|integer',
            'marks.*.final_marks' => 'nullable|integer',
        ]);
        // Iterates through the marks array in the request and creates a new Mark instance for each subject.
        foreach ($request->marks as $markData) {
            $mark = new Mark([
                'subject' => $markData['subject'],
                'monthly_marks' => $markData['monthly_marks'],
                'mid_term_marks' => $markData['mid_term_marks'],
                'final_marks' => $markData['final_marks'],
            ]);
            $student->marks()->save($mark); //links marks to the student
        }

        return redirect()->route('students.marks.index', $student->id)->with('success', 'Marks added successfully.');
    }


    public function edit(Student $student, Mark $mark)
    {
        $marks = $student->marks; // Retrieve all marks associated with the student
        return view('marks.edit', compact('student', 'marks'));
    }
    
    

    public function update(Request $request, Student $student)
{
    // Validates the input, ensuring each mark has an existing ID.
    $request->validate([
        'marks.*.id' => 'required|integer|exists:marks,id',
        'marks.*.monthly_marks' => 'nullable|integer',
        'marks.*.mid_term_marks' => 'nullable|integer',
        'marks.*.final_marks' => 'nullable|integer',
    ]);

    foreach ($request->marks as $markData) {
        //retrieve a record from the database and automatically throws a "ModelNotFoundException" if the record is not found
        $markToUpdate = Mark::findOrFail($markData['id']);
        $markToUpdate->update([
            'monthly_marks' => $markData['monthly_marks'],
            'mid_term_marks' => $markData['mid_term_marks'],
            'final_marks' => $markData['final_marks'],
        ]);
    }

    return redirect()->route('students.marks.index', $student->id)->with('success', 'Marks updated successfully.');
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
