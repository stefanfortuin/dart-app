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
	];

	public function turns(){
		return $this->hasMany(DartTurn::class);
	}
}
