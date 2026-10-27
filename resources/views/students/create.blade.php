@extends('layouts.sms')
@section('title', 'Student Registration')
@section('shell', 'narrow')
@section('content')
<div class="hero" style="background:linear-gradient(135deg,#4361ee,#3a0ca3)">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-graduation-cap"></i></div>
  <h1>Student Registration</h1>
  <p>Complete the form below to register as a new student</p>
</div>
<div class="pad">
  <form method="POST" action="{{ route('students.store') }}">
    @csrf
    @include('students._form')
  </form>
</div>
@endsection
