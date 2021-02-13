<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

	protected $fillable = [
        'game_id',
        'user_id',
		'score',
		'old_score_to_throw_from',
		'new_score_to_throw_from'
    ];

	public function game(){
		return $this->belongsTo(Game::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}
}
