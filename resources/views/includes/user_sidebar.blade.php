<div class="col-md-4">
	<div class="list-group">
		<a class="list-group-item {{Route::is('users.index') ? 'active':''}}" href="{{route('users.index')}}">Dashboard</a>
		<a class="list-group-item {{Route::is('users.edit') ? 'active':''}}" href="{{route('users.edit',Auth::id())}}">Update Profile</a>

		<a class="list-group-item {{Route::is('users.change.password.view') ? 'active':''}}"
		   href="{{route('users.change.password.view')}}">Change Password</a>

		<a class="list-group-item  ? 'active':''}}" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	</div>
</div>