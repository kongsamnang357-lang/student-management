@php $d = $department ?? null; @endphp
<div class="sec"><i class="fa-solid fa-building"></i> Department Information</div>
<div class="fld">
  <i class="fa-solid fa-building-columns"></i>
  <input class="fi" type="text" name="dept_name" value="{{ old('dept_name', $d?->dept_name) }}" placeholder="Department Name">
</div>
@error('dept_name') <div class="er">{{ $message }}</div> @enderror
<div class="two">
  <div class="fld"><i class="fa-solid fa-user-tie"></i>
    <input class="fi" type="number" name="manager_id" value="{{ old('manager_id', $d?->manager_id) }}" placeholder="Manager ID"></div>
  <div class="fld"><i class="fa-solid fa-location-dot"></i>
    <input class="fi" type="number" name="location_id" value="{{ old('location_id', $d?->location_id) }}" placeholder="Location ID"></div>
</div>
<div class="btns">
  <button type="submit" class="b1"><i class="fa-solid fa-paper-plane"></i> {{ $d ? 'Update Department' : 'Save Department' }}</button>
  <button type="reset" class="b2"><i class="fa-solid fa-rotate-left"></i> Reset Form</button>
  <a href="{{ route('departments.index') }}" class="b3"><i class="fa-solid fa-list"></i> View List</a>
</div>
