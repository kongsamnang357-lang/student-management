@extends('layouts.sms')
@section('title', 'Edit Department')
@section('shell', 'narrow')
@section('content')
<div class="hero">
  @include('layouts._topbar')
  <div class="cap"><i class="fa-solid fa-building-columns"></i></div>
  <h1>Edit Department</h1>
  <p>Update the department information below</p>
</div>
<div class="pad">
  <form method="POST" action="{{ route('departments.update', $department) }}">@csrf @method('PUT') @include('departments._form')</form>
</div>
@endsection
