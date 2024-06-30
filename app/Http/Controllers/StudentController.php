<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use App\Services\StudentService;



class StudentController extends Controller
{
    private $StudentService;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('auth');
        $this->StudentService = $studentService;
    }
    public function index(Request $request)
    {
        $query = Student::query();
    
        // Apply filters
        if ($request->filled('payment_status')) {
            switch ($request->payment_status) {
                case 'fully_paid':
                    $query->where('remaining_fees', 0);
                    break;
                case 'partially_paid':
                    // if($query->where('remaining_fees','<','total_fees')){
                            $query->whereColumn('fees_paid', '<', 'total_fees')
                                    ->whereColumn('remaining_fees', '<>', 'total_fees');
                    break;
                case 'not_paid':
                    $query->whereColumn('remaining_fees', '=', 'total_fees');
                    break;
            }
        }
        
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }
        
        $students = $query->paginate(10);
        
        // Get all classes for the filter dropdown
        $classes = Student::distinct()->pluck('class');


        return view('students.index', compact('students','classes'));
    }

    public function create()
    {
        return view('students.create');
    }
    public function store(Request $request)
    {
        
    // Validate the request data with custom error messages
    $validatedData = $request->validate([
        'roll_no' => 'required|string|max:50|unique:students',
        'name' => 'required|string|max:255',
        'class' => 'required|string',
        'total_fees' => 'required|numeric',
        'fees_paid' => 'required|numeric|min:0|max:' . ($request->input('total_fees') - $request->input('fees_paid')),
        'date' => 'required|date'
    ], [
        'roll_no.required' => 'Roll number is required.',
        'roll_no.string' => 'Roll number must be a string.',
        'roll_no.max' => 'Roll number must not exceed 50 characters.',
        'roll_no.unique' => 'Roll number already exists.',
        'name.required' => 'Name is required.',
        'name.string' => 'Name must be a string.',
        'name.max' => 'Name must not exceed 255 characters.',
        'total_fees.required' => 'Total fees is required.',
        'total_fees.numeric' => 'Total fees must be a number.',
        'fees_paid.required' => 'Fees paid is required.',
        'fees_paid.numeric' => 'Fees paid must be a number.',
        'fees_paid.min' => 'Fees paid must be at least 0.',
        'fees_paid.max' => 'Fees paid must not exceed the remaining fees.',
        // 'date.required' => 'Date is required.',
        // 'date.date' => 'Date must be a valid date.',
        // 'date.before_or_equal' => 'Date must not be in the future.'
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
            'class'=> 'required',
            'additional_fees' => 'required|numeric',
            'date' => 'required|date',
            
            // Add other validation rules as needed
        ]);

        // Update the student's data
        $student->name = $request->input('name');
        $student->roll_no = $request->input('roll_no');
        $student->class = $request->input('class');
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
        $students = Student::where('roll_no', 'LIKE', "%{$query}%")
                            ->orWhere('name', 'LIKE', "%{$query}%")
                            ->orWhere('class','LIKE',"%{{$query}%}")
                            // ->orWhere('status','LIKE', "%{$query}%")
                            ->paginate(5);
        
        return view('students.index', compact('students'))->with('success', 'Search results displayed below.');
    }


    public function download()
    {
        $student = Student::all();

        $filename = "student_records.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Roll Number', 'Name','Class', 'Total Fees', 'Fees Paid', 'Remaining Fees', 'Date','Fees_Status']);

        foreach ($student as $student) {
            fputcsv($handle, [
                $student->id,
                $student->roll_no,
                $student->name,
                $student->total_fees,
                $student->fees_paid,
                $student->remaining_fees,
                $student->date,
                $student->payment_status

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
        $students = Student::withTrashed()->get();
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
