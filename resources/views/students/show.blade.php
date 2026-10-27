@extends('layouts.sms')
@section('title', 'Student Details')
@section('shell', 'narrow')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-id-card"></i></div>
  <h1>{{ $student->student_name }}</h1>
  <p>Student details</p>
</div>
<div class="pad">
  <ul class="det">
    <li><b>ID</b> {{ $student->student_id }}</li>
    <li><b>Email</b> {{ $student->email }}</li>
    <li><b>Gender</b> {{ $student->gender }}</li>
    <li><b>Enrollment Date</b> {{ $student->enrollment_date->format('M d, Y') }}</li>
    <li><b>Years Enrolled</b> {{ $student->years_enrolled }} years</li>
    <li><b>Department</b> {{ $student->department->dept_name ?? 'N/A' }}</li>
    <li><b>Description</b> {{ $student->description ?: 'N/A' }}</li>
  </ul>
  <div class="btns">
    <a href="{{ route('students.edit', $student) }}" class="b1"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
    <a href="{{ route('students.index') }}" class="b3"><i class="fa-solid fa-list"></i> View Student List</a>
  </div>
</div>
@endsection
