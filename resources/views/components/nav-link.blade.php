<a href="{{$href}}"
    class="flex flex-col justify-center items-center active:bg-blue-100
        {{ '/'.Request::segment(1) == $href ? 'text-blue-500 font-bold' : 'text-gray-500 font-light'}}
    ">
    <svg class="icon fill-current">
        <use href="/assets/sprite.svg#{{$icon}}"></use>
    </svg>
    <div class="text-xs">
        {{ $title }}
    </div>
</a>