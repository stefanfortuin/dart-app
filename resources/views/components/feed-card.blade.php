@php
$user_two = count($game->users) > 1 ? $game->users[1] : null;
@endphp

<div class="bg-blue-500 py-2 px-3 rounded-lg text-white shadow-md">
    <div class="flex flex-col items-baseline justify-between leading-5">
        <div class="font-light overflow-hidden whitespace-nowrap overflow-ellipsis" style="max-width: 90%;">
            <span class="font-semibold">{{$game->users[0]->name}}</span>
            {{Auth::id() == $game->winner_id ? 'won' : 'verloor'}} van
            {{($user_two != null) ? $user_two->name : 'gast'}}
        </div>
        <div class="text-xs font-light text-white text-opacity-80">{{$game->played_at}}</div>
    </div>

    <div class="grid grid-cols-2 items-baseline gap-x-5">
        <x-feed-card-user :user="$game->users[0]" :game="$game" />
        <x-feed-card-user :user="$user_two" :game="$game" :align="'right'" />
    </div>
</div>