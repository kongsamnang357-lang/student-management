@extends('layouts.sms')
@section('title', 'Student Directory')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-graduation-cap"></i></div>
  <h1>Student Directory</h1>
  <p>Browse and manage all registered students</p>
  <div class="stats">
    <div class="stat"><b>{{ $total }}</b><small>Total Students</small></div>
    <div class="stat"><b>{{ $deptCount }}</b><small>Departments</small></div>
    <div class="stat"><b>{{ $avgYears }} yrs</b><small>Avg. Enrollment</small></div>
  </div>
</div>

@if(session('success')) <div class="alert">{{ session('success') }}</div> @endif
@if(session('error'))   <div class="alert err">{{ session('error') }}</div> @endif

<div class="pad">
  <form method="GET" action="{{ route('students.index') }}" class="panel">
    <div class="search">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search students by name, email, or department...">
    </div>
    <div class="chips">
      <div class="chip"><i class="fa-solid fa-filter"></i>
        <select name="dept_id" onchange="this.form.submit()">
          <option value="">All Departments</option>
          @foreach($departments as $d)
            <option value="{{ $d->dept_id }}" @selected(request('dept_id') == $d->dept_id)>{{ $d->dept_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="chip"><i class="fa-solid fa-sort"></i>
        <select name="sort" onchange="this.form.submit()">
          <option value="newest" @selected(request('sort') != 'oldest')>Newest First</option>
          <option value="oldest" @selected(request('sort') == 'oldest')>Oldest First</option>
        </select>
      </div>
      <div class="chip"><i class="fa-solid fa-venus-mars"></i>
        <select name="gender" onchange="this.form.submit()">
          <option value="">All Genders</option>
          <option value="Male" @selected(request('gender') == 'Male')>Male</option>
          <option value="Female" @selected(request('gender') == 'Female')>Female</option>
        </select>
      </div>
    </div>
  </form>

  <div class="panel" style="padding:6px 14px;overflow-x:auto">
    <table>
      <thead><tr><th>ID</th><th>Student</th><th>Contact</th><th>Enrollment</th><th>Department</th><th>Actions</th></tr></thead>
      <tbody>
      @forelse($students as $s)
        <tr>
          <td class="nm">{{ $s->student_id }}</td>
          <td><div class="nm">{{ $s->student_name }}</div><div class="gd">{{ $s->gender }}</div></td>
          <td>
            <div class="ln"><i class="fa-solid fa-envelope"></i>{{ $s->email }}</div>
            <div class="ln s"><i class="fa-solid fa-file-lines"></i>{{ $s->description ?: 'N/A' }}</div>
          </td>
          <td>
            <div class="ln"><i class="fa-solid fa-calendar-day"></i>{{ $s->enrollment_date->format('M d, Y') }}</div>
            <div class="ln s"><i class="fa-solid fa-clock"></i>{{ $s->years_enrolled }} years</div>
          </td>
          <td><span class="badge"><i class="fa-solid fa-building-columns"></i>{{ $s->department->dept_name ?? 'N/A' }}</span></td>
          <td>
            <div class="acts">
              <a class="ic v" href="{{ route('students.show', $s) }}" title="View"><i class="fa-solid fa-eye"></i></a>
              <a class="ic e" href="{{ route('students.edit', $s) }}" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
              <form method="POST" action="{{ route('students.destroy', $s) }}" onsubmit="return confirm('Delete this student?')">
                @csrf @method('DELETE')
                <button class="ic d" title="Delete"><i class="fa-solid fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="empty">No students found.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>

  <div class="foot">
    <div>Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} entries</div>
    {{ $students->links('pagination.sms') }}
  </div>

  <a href="{{ route('students.create') }}" class="bigbtn"><i class="fa-solid fa-user-plus"></i>&nbsp; Back to Student Form</a>
</div>
@endsection
