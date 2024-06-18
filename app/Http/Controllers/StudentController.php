<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    $students = Student::all();
        $paymentStatus = $request->get('payment_status');
        $studentsQuery = Student::query();

        if ($paymentStatus) {
            if ($paymentStatus == 'fully_paid') {
                $studentsQuery->whereColumn('remaining_fees', 'total_fees');
            } elseif ($paymentStatus == 'not_paid') {
                $studentsQuery->where('remaining_fees', 0);
            } elseif ($paymentStatus == 'partially_paid') {
                $studentsQuery->where('remaining_fees', '>', 0)->whereColumn('remaining_fees', '<', 'total_fees');
            }
        }
        $perPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $students = new LengthAwarePaginator(
            $studentsQuery->forPage($page, $perPage)->get(),
            $studentsQuery->count(),
            $perPage,
            $page,
            ['path' => URL::current(), 'query' => $request->query()]
        );
        $students->appends(['payment_status' => $paymentStatus]);
        
        if ($request->ajax()) {
            return response()->json([
                'students' => $students->items(),
                'pagination' => (string) $students->links()
            ]);
        }

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'roll_no' => 'required|string|max:50|unique:students',
            'name' => 'required|string|max:255',
            'total_fees' => 'required|numeric',
            'fees_paid' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Create a new student record using mass assignment
        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function edit($id){
       
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        // Pass the student to the view
        return view('students.edit', compact('student'));
        
    } 

    public function update(Request $request, $id)
    {
        

        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return redirect()->route('students.index')->with('error', 'Student not found');
        }

        // Validate the request data
        $request->validate([
            'roll_no' => 'required|string|max:50|unique:students,roll_no,' . $id,
            'name' => 'required|string|max:255',
            'additional_fees' => 'required|numeric',
            'date' => 'required|date',
            
            // Add other validation rules as needed
        ]);

        // Update the student's data
        $student->name = $request->input('name');
        $student->roll_no = $request->input('roll_no');
        $student->fees_paid += $request->input('additional_fees');
        $student->date = $request->input('date');

       
        // Update other fields as needed
        $student->save();

        // Redirect to a specific route with a success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    
    }
    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search by roll number or name
        $student = Student::where('roll_no', 'LIKE', "%{$query}%")
                            ->orWhere('name', 'LIKE', "%{$query}%")
                            // ->orWhere('status','LIKE', "%{$query}%")
                            ->get();
        
        return view('students.index', compact('student'))->with('success', 'Search results displayed below.');
    }


    public function download()
    {
        $student = Student::all();

        $filename = "student_records.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Roll Number', 'Name', 'Total Fees', 'Fees Paid', 'Remaining Fees', 'Date']);

        foreach ($student as $student) {
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
    
    public function trash()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trash', compact('students'));
    }

    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route('students.trash')->with('success', 'Student restored successfully');
    }

    public function forceDelete($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->forceDelete();
        return redirect()->route('students.index')->with('success', 'Student permanently deleted');
    }
}
