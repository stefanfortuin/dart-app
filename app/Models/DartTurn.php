<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DartTurn extends Model
{
    use HasFactory;

	protected $fillable = [
        'leg_id',
        'user_id',
		'thrown_score',
		'old_score_to_throw_from',
		'new_score_to_throw_from'
    ];

	public function leg(){
		return $this->belongsTo(DartLeg::class, 'leg_id');
	}

	public function user(){
		return $this->belongsTo(User::class, 'user_id');
	}
}
