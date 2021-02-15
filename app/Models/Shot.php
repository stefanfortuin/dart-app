<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    use HasFactory;

	protected $fillable = [
        'user_id',
		'turn_id',
		'dart_id',
		'thrown_score',
    ];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function turn(){
		return $this->belongsTo(Turn::class);
	}
}
