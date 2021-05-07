<x-base>
    <div class="grid grid-cols-1 gap-y-3">
        @foreach ($games as $game)
            <x-feed-card :game="$game"/>
        @endforeach
    </div>
</x-base>