<?php namespace Modules\Meds\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Meds\Presenters\MedPresenter;

class Med extends Model
{
//    use Translatable;
	use PresentableTrait, SearchableTrait;
	
	public static $packageList =  [
					1 => "Fiolă",
					2 => "Capsulă",
					3 => "Comprimat",
					4 => "Cremă",
					5 => "Emulsie",
					6 => "Granule",
					7 => "Picături",
					8 => "Perfuzabil",
					9 => "Injectabil",
					10 => "Soluție",
					11 => "Loțiune",
					12 => "Spray/ aerosol",
					13 => "Pulbere",
					14 => "Suspensie ",
					15 => "Sirop",
					16 => "Tabletă",
					17 => "Drajeu",
					18 => "Tinctură",
					19 => "Gel",
					20 => "Unguent",
					21 => "Supozitor",
					22 => "Plasture transdermic",
					23 => "Ovul",
					24 => "Altele (este posibil să fiți sunat(ă) pentru detalii)"
				];
	
    protected $table = 'meds__meds';
	protected $presenter = MedPresenter::class;
//    public $translatedAttributes = [];
	protected $fillable = [
		'name',
		'category',
		'active_sub',
		'dosage',
		'package',
		'qty',
		'urgent',
		'unavail_at',
		'manufacturer',
		'country',
		'created_at',
	];
	
	protected $searchable = [
        'columns' => [
			'name' => 5,
			'active_sub' => 4,
			'manufacturer' => 2,
			'reply.cause' => 1,
			'reply.action' => 1,
        ],
        'joins' => [
            'meds__replies as reply' => ['meds__meds.reply_id', 'reply.id'],
//            'meds__replies as reply' => ['meds__meds.id','meds__replies.med_id'],
        ],
    ];
	
	public function patient() {
		return $this->belongsTo(Patient::class, 'patient_id');
    }
	
	public function publicReply() {
		return $this->belongsTo(Reply::class, 'reply_id');
    }
	public function replies() {
		return $this->hasMany(Reply::class, 'med_id');
    }
	
	public function myReply() {
		$auth = app('Modules\Core\Contracts\Authentication');
		return $this->hasOne(Reply::class, 'med_id')->where('user_id', $auth->check()->id);
    }
	
	public  function scopeLike($query, $field, $value){
        return $query->where($field, 'LIKE', "%$value%");
	}
}
