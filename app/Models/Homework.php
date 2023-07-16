<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Homework
 * 
 * @property int $id
 * @property string $title
 * @property int $author_id
 * @property string $classroom
 * @property string $class
 * @property Carbon $date
 * @property Carbon $time
 * @property string $content
 * @property string $associated_res
 * @property string $hw_liked_users
 * @property string $state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Homework extends Model
{
	use HasFactory;
	protected $table = 'homeworks';

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'title',
		'author_id',
		'classroom',
		'class',
		'date',
		'time',
		'content',
		'associated_res',
		'hw_liked_users',
		'state'
	];
}
