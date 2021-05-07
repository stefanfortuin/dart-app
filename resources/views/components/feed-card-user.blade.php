<div class="flex justify-center w-full {{($align == 'right') ? 'flex-row-reverse' : ''}}">
    <div class="flex-shrink-0 font-bold text-4xl flex justify-center items-center rounded">{{$game->setsWonForUser(($user != null) ? $user->id : null)}}</div>
</div>