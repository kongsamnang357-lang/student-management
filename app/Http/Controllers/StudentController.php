<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with('department')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = '%' . $request->search . '%';
                $query->where(function ($q) use ($term) {
                    $q->where('student_name', 'like', $term)
                      ->orWhere('email', 'like', $term)
                      ->orWhereHas('department', fn ($d) => $d->where('dept_name', 'like', $term));
                });
            })
            ->when($request->filled('dept_id'), fn ($q) => $q->where('dept_id', $request->dept_id))
            ->when($request->filled('gender'), fn ($q) => $q->where('gender', $request->gender))
            ->orderBy('student_id', $request->sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(10)
            ->withQueryString();

        $avgYears = round(
            Student::get(['student_id', 'enrollment_date'])->avg(fn ($s) => $s->years_enrolled) ?? 0,
            1
        );

        return view('students.index', [
            'students'    => $students,
            'departments' => Department::orderBy('dept_name')->get(),
            'total'       => Student::count(),
            'deptCount'   => Department::count(),
            'avgYears'    => $avgYears,
        ]);
    }

    public function create()
    {
        return view('students.create', ['departments' => Department::orderBy('dept_name')->get()]);
    }

    public function store(Request $request)
    {
        Student::create($this->validated($request));
        return redirect()->route('students.index')->with('success', 'Student registered successfully.');
    }

    public function show(Student $student)
    {
        $student->load('department');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'departments' => Department::orderBy('dept_name')->get(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student));
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'student_name'    => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'max:255',
                                  Rule::unique('students', 'email')->ignore($student?->student_id, 'student_id')],
            'gender'          => ['required', Rule::in(['Male', 'Female'])],
            'enrollment_date' => ['required', 'date'],
            'dept_id'         => ['required', 'exists:departments,dept_id'],
            'description'     => ['nullable', 'string'],
        ]);
    }
}
