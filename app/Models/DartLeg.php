<?php

namespace App\Models;

use App\Models\DartTurn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DartLeg extends Model
{
    use HasFactory;

	protected $fillable = [
		'turns',
		'set_id',
		'winner_id',
		'game_id'
	];

	protected $with = ['turns'];

	public function turns(){
		return $this->hasMany(DartTurn::class, 'leg_id');
	}

	public function winner(){
		return $this->hasOne(User::class, 'winner_id');
	}

	public function setTurnsAttribute($turns){
		// $this->turns()->createMany($turns);

		foreach ($turns as $turn) {
			$turn['game_id'] = $this->game_id;
			$new_turn = $this->turns()->create($turn);
			$new_turn->save();
		}
	}
}
