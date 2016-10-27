<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
//    use Translatable;

    protected $table = 'meds__replies';
//    public $translatedAttributes = [];
	protected $fillable = [
		'user_id',
		'med_id',
		'category',
		'cause',
		'action',
		'deadline',
//		'is_public',
		'created_at',
	];
    protected $casts = [
        'deadline' => 'datetime',
        'is_public' => 'boolean',
    ];
	public function meds() {
		return $this->HasMany(Med::class, 'reply_id');
    }
	public function med() {
		return $this->belongsTo(Med::class, 'med_id');
    }
	public function user() {
		return $this->belongsTo('Modules\User\Entities\Sentinel\User');
    }
}
