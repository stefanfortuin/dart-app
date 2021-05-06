<div class="flex justify-between items-baseline my-3 w-full {{($align == 'right') ? 'flex-row-reverse' : ''}}">
    <x-avatar :user="$user" />
    <x-user-name>
        {{($user != null) ? $user->name : 'gast'}}
    </x-user-name>
    <div class="flex-shrink-0">{{$game->setsWonForUser(($user != null) ? $user->id : null)}}</div>
</div>