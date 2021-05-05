<x-base>
    <div class="grid grid-cols-1 gap-y-2">
        @foreach ($games as $game)
            <x-feed-card :game="$game"/>
        @endforeach
    </div>
    <script src="{{mix('js/feed.js')}}"></script>
</x-base>