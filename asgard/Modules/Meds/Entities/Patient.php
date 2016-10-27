<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
//    use Translatable;
	public static $statuses = [
			0 => 'În aşteptare',
			1 => 'Publicat',
			2 => 'Neeligibil',
			-1 => 'Respins',
		];
	
	public static $roles =  [
			1 => "Persoana care are nevoie de medicament",
			2 => "Apartinator al persoanei care are nevoie de tratament",
			3 => "Medic curant",
			4 => "Farmacist"
		];
	
    protected $table = 'meds__patients';
//    public $translatedAttributes = [];
	protected $fillable = [
		'first_name',
		'last_name',
		'address',
		'phone',
		'alt_phone',
		'email',
		'role',
		'allow_contact',
		'created_at',
	];
	
	public function med() {
		return $this->hasOne(Med::class, 'patient_id');
    }
	public function contact() {
		return $this->hasOne(Contact::class, 'patient_id');
    }
	public function recipe() {
		return $this->hasOne(Recipe::class, 'patient_id');
    }
//	public function reply() {
//		return $this->hasOne(Reply::class, 'patient_id');
//    }
	
	public static function getStatus($statusName) {
//		array_search(strtolower($search), array_map('strtolower', $array));
		return array_search($statusName, self::$statuses);
	}
}
