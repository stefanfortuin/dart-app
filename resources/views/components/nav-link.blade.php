<a href="{{$href}}"
    class="flex flex-col justify-center items-center active:bg-blue-100
        {{ Request::is($href) ? 'text-blue-500' : 'text-gray-500'}}
    ">
    <svg class="icon fill-current">
        <use xlink:href="assets/sprite.svg#{{$icon}}"></use>
    </svg>
    <div class="font-light text-xs">
        {{ $title }}
    </div>
</a>