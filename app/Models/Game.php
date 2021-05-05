<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

	protected $fillable = [
		'sets',
        'winner_id',
    ];

	protected $with = ['sets'];

	public function sets(){
		return $this->hasMany(DartSet::class);
	}

	public function legs(){
		return $this->hasMany(DartLeg::class);
	}

	public function turns(){
		return $this->hasMany(DartTurn::class);
	}

	public function users(){
		return $this->belongsToMany(User::class, 'game_user');
	}

	public function winner(){
		return $this->hasOne(User::class, 'winner_id');
	}

	public function setsWonForUser($user_id){
		return $this->sets()->where('winner_id', $user_id)->count();
	}

	public function legsWonForUser($user_id){
		return $this->legs()->where('winner_id', $user_id)->count();
	}

	public function averagePerTurnForUser($user_id){
		return round($this->turns()->where('user_id', $user_id)->average('thrown_score'), 2);
	}

	public function setSetsAttribute($sets){
		foreach ($sets as $set) {
			$new_set = $this->sets()->create(['winner_id' => $set['winner_id']]);
			$new_set->legs = $set['legs'];
			$new_set->save();
		}
	}

	public function getPlayedAtAttribute(){
		return Carbon::parse($this->created_at)->locale('nl_NL')->setTimezone('Europe/Amsterdam')->translatedFormat('j F Y h:i');
	}
}
