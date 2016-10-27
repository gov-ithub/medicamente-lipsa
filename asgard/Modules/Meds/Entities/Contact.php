<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
//    use Translatable;

    protected $table = 'meds__contacts';
//    public $translatedAttributes = [];
	protected $fillable = [
		'first_name',
		'last_name',
		'phone',
		'email',
		'created_at',
	];
	
	public function patient() {
		return $this->belongsTo(Patient::class, 'patient_id');
    }
	
}
