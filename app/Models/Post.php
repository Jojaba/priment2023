<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

//use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $title
 * @property string $target
 * @property int $author_id
 * @property string $content
 * @property string $associated_res
 * @property string $post_liked_users
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models
 */
class Post extends Model
{
	use HasFactory;
	protected $table = 'posts';

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'title',
		'target',
		'author_id',
		'content',
		'associated_res',
		'post_liked_users',
		'state',
		'updated_at'
	];
}
