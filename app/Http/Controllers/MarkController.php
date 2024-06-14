<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Mark;

class MarkController extends Controller
{
    private $subjects = [
        'Account',
        'Economics',
        'Statastics',
        'B.A.',
        'English',
        'Gujarati',
        'Computer'
    ];

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


    public function edit(Student $student, Mark $mark)
    {
        $subjects = $this->subjects;
        return view('marks.edit', compact('student', 'mark', 'subjects'));
    }

    public function update(Request $request, Student $student, Mark $mark)
    {
        $request->validate([
            'subject' => 'required|string',
            'marks.*.id' => 'required|integer|exists:marks,id',
            'marks.*.monthly_marks' => 'nullable|integer',
            'marks.*.mid_term_marks' => 'nullable|integer',
            'marks.*.final_marks' => 'nullable|integer',
        ]);

        $mark->update($request->all());

        return redirect()->route('students.marks.index', $student)->with('success', 'Marks updated successfully.');
    }

    public function destroy(Student $student, Mark $mark)
    {
        $mark->delete();

        return redirect()->route('students.marks.index', $student)->with('success', 'Marks deleted successfully.');
    }
    public function download()
    {
        $mark = Mark::all();

        $filename = "student_marks.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Roll Number', 'Name','subject','monthly_marks','mid_term_marks','final_marks', ]);

        foreach ($mark as $mark) {
            fputcsv($handle, [
                $mark->id,
                $mark->roll_no,
                $mark->name,
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
