<div class="flex flex-col mb-2">
	<div class="flex justify-between text-sm px-1">
		<div class="font-semibold text-blue-500">
			{{$title}}
		</div>
		<div class="font-bold">
			{{round($value / $max * 100, 2)}}%
		</div>
	</div>
	<x-progress-bar :max="$max" :value="$value" />
</div>