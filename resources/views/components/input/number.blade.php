<div class="flex flex-col mb-1">
	<label for="{{$id}}" class="mb-1 text-lg font-semibold text-blue-400">{{ $label}}</label>
	<input
		type="number"
		id="{{$id}}"
		min="{{$min}}"
		max="{{$max}}"
		class="border-2 border-blue-200 py-1 px-3 placeholder-blue-100 rounded-lg text-2xl font-semibold text-blue-500"
		{{$attributes->wire('model')}}
	>
</div>