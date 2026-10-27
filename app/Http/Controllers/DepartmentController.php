<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::withCount('students')
            ->when($request->filled('search'), fn ($q) => $q->where('dept_name', 'like', '%' . $request->search . '%'))
            ->orderBy('dept_id')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Department::create($this->validated($request));
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($this->validated($request));
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        if ($department->students()->exists()) {
            return back()->with('error', 'Cannot delete: this department still has students.');
        }

        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'dept_name'   => ['required', 'string', 'max:255'],
            'manager_id'  => ['nullable', 'integer'],
            'location_id' => ['nullable', 'integer'],
        ]);
    }
}
