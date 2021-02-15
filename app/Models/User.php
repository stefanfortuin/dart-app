<?php

namespace App\Models;

use App\Models\Turn;
use App\Models\Match;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
		'created_at',
		'updated_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected $with = ['games', 'turns'];

	public function turns(){
		return $this->hasMany(Turn::class);
	}

	public function shots(){
		return $this->hasMany(Shot::class);
	}

	public function games(){
		return $this->belongsToMany(Game::class, 'game_user');
	}
}
