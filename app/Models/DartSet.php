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
	];

	public function legs(){
		return $this->hasMany(DartLeg::class);
	}
}
