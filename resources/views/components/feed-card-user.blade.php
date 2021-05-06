<div class="flex justify-between items-center my-2 w-full {{($align == 'right') ? 'flex-row-reverse' : ''}}">
    <x-avatar :user="$user" />
    <x-user-name :textAlign="$align">
        {{($user != null) ? $user->name : 'gast'}}
    </x-user-name>
    <div class="flex-shrink-0 font-bold text-xl flex justify-center items-center text-blue-500 rounded">{{$game->setsWonForUser(($user != null) ? $user->id : null)}}</div>
</div>