<button {{$attributes}}
	class="w-full transition-colors font-semibold text-xl text-white p-3 rounded-lg shadow my-2 flex justify-center items-center select-none {{($disabled) ? 'bg-gray-200 opacity-75' : 'bg-blue-500'}}">
	{{$slot}}
</button>