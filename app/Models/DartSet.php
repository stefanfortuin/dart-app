<?php

namespace App\Models;

use App\Models\DartLeg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DartSet extends Model
{
    use HasFactory;

	protected $fillable = [
		'legs',
		'game_id',
		'winner_id',
	];

	protected $with = ['legs'];

	public function game(){
		return $this->belongsTo(Game::class);
	}

	public function legs(){
		return $this->hasMany(DartLeg::class, 'set_id');
	}

	public function winner(){
		return $this->hasOne(User::class, 'winner_id');
	}

	public function setLegsAttribute($legs){
		foreach ($legs as $leg) {
			$new_leg = $this->legs()->create(['winner_id' => $leg['winner_id'], 'game_id' => $this->game_id]);
			$new_leg->turns = $leg['turns'];
			$new_leg->save();
		}
	}
}
