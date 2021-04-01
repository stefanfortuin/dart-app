<div class="w-full flex h-8 mb-3 text-center text-lg text-gray-800 font-semibold">
	<div style="width: {{$lostWidth}}%;" class="bg-red-400 {{($lostWidth == 100) ? 'rounded' : 'rounded-l'}}">
		<div class="h-full">{{$lost}}</div>
	</div>
	<div style="width: {{$wonWidth}}%;" class="bg-green-400 {{($wonWidth == 100) ? 'rounded' : 'rounded-r'}}">
		<div class="h-full">{{$won}}</div>
	</div>
</div>