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
        $subjects = $this->subjects;
        return view('marks.create', compact('student', 'subjects'));
    }

    public function store(Request $request, Student $student)
    {
        $request->validate([
            'subject' => 'required|string',
            'exam_type' => 'required|in:monthly,mid-term,final',
            'marks' => 'required|integer',
        ]);

        $mark = new Mark($request->all());
        $mark->student_id = $student->id;
        $mark->save();

        return redirect()->route('students.marks.index', $student)->with('success', 'Marks added successfully.');
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
            'exam_type' => 'required|in:monthly,mid-term,final',
            'marks' => 'required|integer',
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
        fputcsv($handle, ['ID', 'Roll Number', 'Name','subject','exam_type','marks' ]);

        foreach ($mark as $mark) {
            fputcsv($handle, [
                $mark->id,
                $mark->roll_no,
                $mark->name,
                $mark->subject,
                $mark->exam_type,
                $mark->marks
                
            ]);
        }

        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
}
