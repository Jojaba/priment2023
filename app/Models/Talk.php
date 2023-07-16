<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Talk
 * 
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property int $author_id
 * @property string $recipients_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Talk extends Model
{
	use HasFactory;
	protected $table = 'talks';

	protected $casts = [
		'author_id' => 'int'
	];

	protected $fillable = [
		'subject',
		'content',
		'author_id',
		'recipients_id'
	];
}
