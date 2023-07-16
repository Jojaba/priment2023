<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Resource
 * 
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $location
 * @property string $type
 * @property int $author_id
 * @property string $res_liked_users
 * @property string $state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Resource extends Model
{
	use HasFactory;
	protected $table = 'resources';

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'title',
		'url',
		'location',
		'type',
		'author_id',
		'res_liked_users',
		'state'
	];
}
