<div class="bg-blue-500 p-2 rounded-lg text-white">
    <div class="flex items-baseline justify-between">
        <div class="font-light">
            <span class="font-semibold">{{$game->users[0]->name}}</span>
            {{Auth::id() == $game->winner_id ? 'won' : 'verloor'}} van
            {{count($game->users) > 1 ? $game->users[1]->name : 'gast'}}
        </div>
        <div class="text-sm font-light opacity-75">{{$game->played_at}}</div>
    </div>
    <div class="grid grid-cols-8 gap-x-2">
        <div class="text-right flex flex-col col-span-3">
            <div>{{$game->users[0]->name}}</div>
            <div>{{$game->setsWonForUser($game->users[0]->id)}}</div>
            <div>{{$game->legsWonForUser($game->users[0]->id)}}</div>
            <div>{{$game->averagePerTurnForUser($game->users[0]->id)}}</div>
        </div>
        <div class="text-center flex flex-col col-span-2">
            <div>Naam</div>
            <div>Sets</div>
            <div>Legs</div>
            <div>Gem.</div>
        </div>
        <div class="text-left flex flex-col col-span-3">
            @php
                $user_two_id = count($game->users) > 1 ? $game->users[1]->id : null;
                $user_two_name = count($game->users) > 1 ? $game->users[1]->name : 'gast';
            @endphp
            <div>{{$user_two_name}}</div>
            <div>{{$game->setsWonForUser($user_two_id)}}</div>
            <div>{{$game->legsWonForUser($user_two_id)}}</div>
            <div>{{$game->averagePerTurnForUser($user_two_id)}}</div>
        </div>
    </div>
</div>