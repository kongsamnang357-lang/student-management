@extends('layouts.sms')
@section('title', 'Add Department')
@section('shell', 'narrow')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-building-columns"></i></div>
  <h1>Add Department</h1>
  <p>Fill in the department information below</p>
</div>
<div class="pad">
  <form method="POST" action="{{ route('departments.store') }}">@csrf @include('departments._form')</form>
</div>
@endsection
