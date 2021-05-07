@php
$user_two = count($game->users) > 1 ? $game->users[1] : null;
$won = Auth::id() == $game->winner_id;
@endphp

<div class="py-2 px-3 flex justify-between shadow rounded-lg bg-blue-500 text-white">
    <div class="flex-grow flex flex-col justify-center items-baseline leading-5">
        <div class="text-sm font-light break-words" style="max-width: 90%;">
            <span class="font-semibold">{{$game->users[0]->name}}</span>
            {{ $won ? 'won' : 'verloor'}} van
            {{($user_two != null) ? $user_two->name : 'gast'}}
        </div>
        <div class="text-xs text-gray-100 text-opacity-80 leading-6">{{$game->played_at}}</div>
    </div>

    <div class="w-3/12 flex justify-center items-center">
        <x-feed-card-user :user="$game->users[0]" :game="$game" />
        <div class="mx-1 text-xl">:</div>
        <x-feed-card-user :user="$user_two" :game="$game" :align="'right'" />
    </div>
</div>