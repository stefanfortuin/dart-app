<x-base>
    <div class="grid grid-cols-1 gap-y-2">
        @foreach ($games as $game)
        <x-feed-game :game="$game"/>
        @endforeach
    </div>
</x-base>