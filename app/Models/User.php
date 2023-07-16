<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $forename
 * @property string $identity
 * @property int $role
 * @property Carbon|null $birthdate
 * @property string $classroom
 * @property string $class
 * @property string $level
 * @property string $news_liked
 * @property string $hw_liked
 * @property string $res_liked
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasFactory;
	protected $table = 'users';

	protected $casts = [
		'role' => 'int'
	];

	protected $dates = [
		'birthdate',
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'forename',
		'identity',
		'role',
		'birthdate',
		'classroom',
		'class',
		'level',
		'news_liked',
		'hw_liked',
		'res_liked',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];
}
