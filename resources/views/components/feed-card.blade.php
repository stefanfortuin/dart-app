<div class="bg-blue-500 py-2 px-3 rounded-lg text-white shadow-md">
    <div class="flex items-baseline justify-between">
        <div class="font-light">
            <span class="font-semibold">{{$game->users[0]->name}}</span>
            {{Auth::id() == $game->winner_id ? 'won' : 'verloor'}} van
            {{count($game->users) > 1 ? $game->users[1]->name : 'gast'}}
        </div>
        <div class="text-sm font-light opacity-75">{{$game->played_at}}</div>
    </div>
    <div class="grid grid-col-8">
        <div class="col-span-6 grid grid-cols-2">
            <div class="flex flex-col leading-4">
                <div class="text-sm font-light">Sets.</div>
                <div class="">{{$game->setsWonForUser($game->users[0]->id)}}</div>
            </div>
            <div class="flex flex-col leading-4">
                <div class="text-sm font-light">Legs.</div>
                <div>{{$game->legsWonForUser($game->users[0]->id)}}</div>
            </div>
            <div class="flex flex-col leading-4">
                <div class="text-sm font-light">Gem.</div>
                <div>{{$game->averagePerTurnForUser($game->users[0]->id)}}</div>
            </div>
        </div>
    </div>
</div>