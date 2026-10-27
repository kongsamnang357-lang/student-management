@extends('layouts.sms')
@section('title', 'Department Directory')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-building-columns"></i></div>
  <h1>Department Directory</h1>
  <p>Manage all departments</p>
</div>

@if(session('success')) <div class="alert">{{ session('success') }}</div> @endif
@if(session('error'))   <div class="alert err">{{ session('error') }}</div> @endif

<div class="pad">
  <form method="GET" action="{{ route('departments.index') }}" class="panel">
    <div class="search">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search departments by name...">
    </div>
  </form>

  <div class="panel" style="padding:6px 14px;overflow-x:auto">
    <table>
      <thead><tr><th>ID</th><th>Department Name</th><th>Manager ID</th><th>Location ID</th><th>Students</th><th>Actions</th></tr></thead>
      <tbody>
      @forelse($departments as $d)
        <tr>
          <td class="nm">{{ $d->dept_id }}</td>
          <td><span class="badge"><i class="fa-solid fa-building-columns"></i>{{ $d->dept_name }}</span></td>
          <td>{{ $d->manager_id ?? '-' }}</td>
          <td>{{ $d->location_id ?? '-' }}</td>
          <td class="nm">{{ $d->students_count }}</td>
          <td>
            <div class="acts">
              <a class="ic e" href="{{ route('departments.edit', $d) }}" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
              <form method="POST" action="{{ route('departments.destroy', $d) }}" onsubmit="return confirm('Delete this department?')">
                @csrf @method('DELETE')
                <button class="ic d" title="Delete"><i class="fa-solid fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="empty">No departments found.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>

  <div class="foot">
    <div>Showing {{ $departments->firstItem() ?? 0 }} to {{ $departments->lastItem() ?? 0 }} of {{ $departments->total() }} entries</div>
    {{ $departments->links('pagination.sms') }}
  </div>

  <a href="{{ route('departments.create') }}" class="bigbtn"><i class="fa-solid fa-plus"></i>&nbsp; Add New Department</a>
</div>
@endsection
