<div class="flex justify-between items-center border-2 border-blue-200 rounded-lg py-1 px-3">
	<label class="text-2xl font-semibold text-blue-400 overflow-ellipsis overflow-hidden whitespace-nowrap" for="{{$id}}">{{$label}}</label>
    <input class="" type="radio" name="{{$name}}" value="{{$value}}" id="{{$id}}" {{$attributes->wire('model')}}>
</div>