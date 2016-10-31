<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Reply1 extends Model
{
//    use Translatable;

    protected $table = 'replies';
//    public $translatedAttributes = [];
	protected $fillable = [
		'med_id',
		'cause',
		'action',
		'deadline',
//		'is_public',
		'created_at',
	];
    protected $casts = [
        'deadline' => 'datetime',
    ];

}
