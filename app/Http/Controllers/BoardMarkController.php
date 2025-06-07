<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BoardMark;
use App\Models\Student;

class BoardMarkController extends Controller
{
    public function index()
    {
        $students = Student::with('boardMarks')->get();
        $classes = Student::distinct()->pluck('class')->toArray();
        $boardmarks = BoardMark::with('student')->get();
        return view('boardmarks.index', compact('students', 'classes', 'boardmarks'));
    }

    public function create()
    {
        $students = Student::all();
        return view('boardmarks.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'account' => 'required|integer',
            'statistics' => 'required|integer',
            'total' => 'required|integer',
            'percentage' => 'required|numeric',
            'grade' => 'required|string',
        ]);

        BoardMark::create($request->all());

        return redirect()->route('boardmarks.index')->with('success', 'Board marks added successfully');
    }

    public function edit(BoardMark $boardmark)
    {
        $students = Student::all();
        return view('boardmarks.edit', compact('boardmark', 'students'));
    }

    public function update(Request $request, BoardMark $boardmark)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'account' => 'required|integer',
            'statistics' => 'required|integer',
            'total' => 'required|integer',
            'percentage' => 'required|numeric',
            'grade' => 'required|string',
        ]);

        $boardmark->update($request->all());

        return redirect()->route('boardmarks.index')->with('success', 'Board marks updated successfully');
    }

    public function destroy(BoardMark $boardmark)
    {
        $boardmark->delete();
        return redirect()->route('boardmarks.index')->with('success', 'Board marks deleted successfully');
    }
        public function download()
        {
            $boardMarks = BoardMark::all();
            
            $filename = 'board_marks.csv';
            $file = fopen($filename, 'w+');
            
            
            // Write the CSV header
            fputcsv($file, ['Student ID', 'Account', 'Statistics', 'Total', 'Percentage', 'Grade']);
            
            // Write the board marks data
            foreach ($boardMarks as $boardMark) {
                fputcsv($file, [
                    $boardMark->student_id,
                    $boardMark->account,
                    $boardMark->statistics,
                    $boardMark->total,
                    $boardMark->percentage,
                    $boardMark->grade,
                ]);
            }
            
            fclose($file);
            
            $headers = [
                'Content-Type' => 'text/csv',
            ];
            return response()->download($filename, $filename, $headers)->deleteFileAfterSend(true);
        }
}
