<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

	protected $fillable = [
        'winner_id',
    ];

	public function turns(){
		return $this->hasMany(Turn::class);
	}

	public function players(){
		return $this->belongsToMany(User::class, 'match_player');
	}

	public function winner(){
		return $this->hasOne(User::class, 'winner_id');
	}
}
