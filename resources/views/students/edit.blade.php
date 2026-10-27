@extends('layouts.sms')
@section('title', 'Edit Student')
@section('shell', 'narrow')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-user-pen"></i></div>
  <h1>Edit Student</h1>
  <p>Update the student information below</p>
</div>
<div class="pad">
  <form method="POST" action="{{ route('students.update', $student) }}">
    @csrf @method('PUT')
    @include('students._form')
  </form>
</div>
@endsection
