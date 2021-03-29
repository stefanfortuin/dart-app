<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

	protected $fillable = [
        'winner_id',
    ];

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
}
