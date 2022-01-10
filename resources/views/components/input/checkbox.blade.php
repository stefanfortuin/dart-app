<div>
	<label for="{{$id}}">{{$label}}</label>
    <input type="checkbox" name="{{$name}}" value="{{$value}}" id="{{$id}}" {{$attributes->wire('model')}}>
</div>