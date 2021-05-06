@php
$user_two = count($game->users) > 1 ? $game->users[1] : null;
$won = Auth::id() == $game->winner_id;
@endphp

<div class="py-2 px-3 rounded-lg border-2 border-gray-200">
    <div class="flex flex-col items-baseline justify-between leading-5 mb-2">
        <div class="font-light overflow-hidden whitespace-nowrap overflow-ellipsis" style="max-width: 90%;">
            <span class="font-semibold">{{$game->users[0]->name}}</span>
            <span class="{{$won ? 'text-green-600' : 'text-red-400'}}">{{ $won ? 'won' : 'verloor'}}</span> van
            {{($user_two != null) ? $user_two->name : 'gast'}}
        </div>
        <div class="text-xs font-light text-opacity-50">{{$game->played_at}}</div>
    </div>

    <div class="flex items-baseline">
        <x-feed-card-user :user="$game->users[0]" :game="$game" />
        <div class="mx-2">:</div>
        <x-feed-card-user :user="$user_two" :game="$game" :align="'right'" />
    </div>
</div>