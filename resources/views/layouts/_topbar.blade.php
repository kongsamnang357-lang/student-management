<div class="top">
  <div>
    <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'on' : '' }}">Students</a>
    <a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'on' : '' }}">Departments</a>
  </div>
  <div>
    <span style="margin-right:10px"><i class="fa-regular fa-user"></i> {{ auth()->user()->name }}</span>
    <form method="POST" action="{{ route('logout') }}">@csrf<button><i class="fa-solid fa-right-from-bracket"></i> Logout</button></form>
  </div>
</div>
