<x-base>
    {{$user->name}}
		<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}" >Uitloggen</a>
	<form id="logout-form" action="{{route('logout')}}" method="post" class="hidden">
		@csrf
	</form>
</x-base>