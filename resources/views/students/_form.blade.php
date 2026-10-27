@php $s = $student ?? null; @endphp
<div class="sec"><i class="fa-solid fa-circle-user"></i> Personal Information</div>

<div class="fld">
  <i class="fa-solid fa-user"></i>
  <input class="fi" type="text" name="student_name" value="{{ old('student_name', $s?->student_name) }}" placeholder="Student Name">
</div>
@error('student_name') <div class="er">{{ $message }}</div> @enderror

<div class="fld">
  <i class="fa-solid fa-envelope"></i>
  <input class="fi" type="email" name="email" value="{{ old('email', $s?->email) }}" placeholder="Email Address">
</div>
@error('email') <div class="er">{{ $message }}</div> @enderror

<div class="fld">
  <label><i class="fa-solid fa-venus-mars"></i>Gender</label>
  <select class="fi" name="gender" style="padding-left:14px">
    <option value=""></option>
    @foreach(['Male','Female'] as $g)
      <option value="{{ $g }}" @selected(old('gender', $s?->gender) == $g)>{{ $g }}</option>
    @endforeach
  </select>
</div>
@error('gender') <div class="er">{{ $message }}</div> @enderror

<div class="sec" style="margin-top:18px"><i class="fa-solid fa-building-columns"></i> Academic Information</div>

<div class="two">
  <div>
    <div class="fld">
      <label><i class="fa-solid fa-calendar-day"></i>Enrollment Date</label>
      <input class="fi" style="padding-left:12px" type="date" id="enrollment_date" name="enrollment_date"
             value="{{ old('enrollment_date', $s?->enrollment_date?->format('Y-m-d')) }}">
    </div>
    @error('enrollment_date') <div class="er">{{ $message }}</div> @enderror
  </div>
  <div class="fld">
    <i class="fa-solid fa-clock"></i>
    <input class="fi" type="text" id="years" readonly placeholder="Years Enrolled">
  </div>
</div>

<div class="fld">
  <label><i class="fa-solid fa-building"></i>Department</label>
  <select class="fi" name="dept_id" style="padding-left:14px">
    <option value=""></option>
    @foreach($departments as $d)
      <option value="{{ $d->dept_id }}" @selected(old('dept_id', $s?->dept_id) == $d->dept_id)>{{ $d->dept_name }}</option>
    @endforeach
  </select>
</div>
@error('dept_id') <div class="er">{{ $message }}</div> @enderror

<div class="lab"><i class="fa-solid fa-file-lines"></i> Additional Information</div>
<textarea name="description" placeholder="Enter any additional information about the student">{{ old('description', $s?->description) }}</textarea>

<div class="btns">
  <button type="submit" class="b1"><i class="fa-solid fa-paper-plane"></i> {{ $s ? 'Update Student' : 'Submit Registration' }}</button>
  <button type="reset" class="b2"><i class="fa-solid fa-rotate-left"></i> Reset Form</button>
  <a href="{{ route('students.index') }}" class="b3"><i class="fa-solid fa-list"></i> View Student List</a>
</div>

<script>
(function () {
  var d = document.getElementById('enrollment_date'), y = document.getElementById('years');
  function calc() {
    if (!d.value) { y.value = ''; return; }
    var yrs = (Date.now() - new Date(d.value).getTime()) / (365.25 * 24 * 3600 * 1000);
    y.value = Math.abs(yrs).toFixed(2) + ' years';
  }
  d.addEventListener('change', calc);
  d.form.addEventListener('reset', function () { setTimeout(calc, 0); });
  calc();
})();
</script>
