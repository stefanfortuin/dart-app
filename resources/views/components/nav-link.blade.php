<a href="{{$href}}"
    class="flex flex-col justify-center items-center active:bg-blue-100
        {{ '/'.Request::segment(1) == $href ? 'text-blue-500 font-bold' : 'text-gray-500 font-light'}}
    ">
    <div class="icon fill-current">
    {!! file_get_contents(public_path('/assets/icons/'.$icon.'.svg')) !!}
    </div>
    <div class="text-xs">
        {{ $title }}
    </div>
</a>