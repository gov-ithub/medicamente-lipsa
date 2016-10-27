<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
//    use Translatable;

    protected $table = 'meds__recipes';
//    public $translatedAttributes = [];
	protected $fillable = [
		'required',
		'issued_by',
		'doctor',
		'phone',
		'created_at',
	];	
	public function patient() {
		return $this->belongsTo(Patient::class, 'patient_id');
    }
}
