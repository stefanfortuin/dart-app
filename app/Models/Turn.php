<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

	protected $fillable = [
        'match_id',
        'user_id',
		'score',
    ];

	public function match(){
		return $this->belongsTo(Match::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}
}
