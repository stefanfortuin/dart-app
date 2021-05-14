@push('scripts')
<script>
	function updateProfileSettings(){
		let formElement = document.getElementById('form-settings');
		let formData = new FormData(formElement);

		fetch("/profile/settings", {
			method: "post",
			body: formData,
		}).then(() => {
			let button = document.getElementById('save-settings');

			button.innerText = "Opgeslagen"
			button.classList.toggle('bg-blue-500');
			button.classList.toggle('bg-green-500')

			setTimeout(() => {
				button.classList.toggle('bg-green-500')
				button.classList.toggle('bg-blue-500')
				button.innerText = "Instellingen opslaan"
			}, 1000);
		})
	}

</script>
@endpush

<x-base>

	<div class="w-full h-12 flex justify-between items-center border-b-2 border-blue-200">
		<div class="font-bold text-2xl">
			{{$user->name}}
		</div>
	</div>

	@if (count($user->games) > 0)
	<div class="my-3">
		<x-stats-block title="Gewonnen" :max="$user->total_games" :value="$user->total_games_won" />
		<x-stats-block title="Sets Gewonnen" :max="$user->total_sets" :value="$user->total_sets_won" />
		<x-stats-block title="Legs Gewonnen" :max="$user->total_legs" :value="$user->total_legs_won" />
	</div>
	@endif

	<div class="my-3">
		<h2 class="text-xl font-bold">Instellingen</h2>
		<form action="/profile/settings" method="post" id="form-settings">
			@csrf

			<div class="flex justify-between items-center">
				<label class="text-lg" for="microphone_input">Microfoon</label>
				<input class="h-5 w-5" type="checkbox" name="microphone_input" id="microphone_input"
					{{array_key_exists('microphone_input', Auth::user()->settings) ? 'checked' : ''}}>
			</div>

		</form>

		<a id="save-settings" onclick="event.preventDefault(); updateProfileSettings();"
			class="transition-colors w-full font-semibold text-lg text-white p-2 rounded-lg shadow my-2 flex justify-center items-center bg-blue-500 select-none">Instellingen
			opslaan</a>
	</div>


	<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{route('logout')}}"
		class="font-semibold text-xl text-red-500 p-3 rounded-lg shadow my-2 flex justify-center items-center bg-red-100 border-2 border-red-500 select-none">Uitloggen</a>
	<form id="logout-form" action="{{route('logout')}}" method="post" class="hidden">
		@csrf
	</form>
</x-base>