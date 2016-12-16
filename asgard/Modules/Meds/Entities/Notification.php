<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
//    use Translatable;

    protected $table = 'meds__notifications';
//    public $translatedAttributes = [];
	protected $fillable = [
		'patient_id',
		'email',
		'created_at',
	];
	public function patient() {
		return $this->belongsTo(Patient::class, 'patient_id');
    }
}
