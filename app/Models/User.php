<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Match;
use App\Models\DartTurn;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'created_at',
		'updated_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected $with = ['games', 'turns'];

	public function turns(){
		return $this->hasMany(DartTurn::class);
	}

	public function games(){
		return $this->belongsToMany(Game::class, 'game_user');
	}

	public function getLatestGameDateAttribute(){
		return Carbon::parse($this->games()->latest('created_at')->first()->created_at)->locale('nl_NL')->diffForHumans();
	}

	// Games
	public function getTotalGamesAttribute(){
		return $this->games->count();
	}

	public function getTotalGamesWonAttribute(){
		return $this->games->where('winner_id', $this->id)->count();
	}

	// Sets
	public function getTotalSetsAttribute(){
		return $this->games->reduce(function ($carry, $game) {
			return $carry + $game->sets->count();
		});
	}

	public function getTotalSetsWonAttribute(){
		return $this->games->reduce(function ($carry, $game) {
			return $carry + $game->sets->where('winner_id', $this->id)->count();
		});
	}

	// Turns
	public function getAveragePerTurnAttribute(){
		return round($this->turns->average('thrown_score'), 2);
	}
}
