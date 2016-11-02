<?php namespace Modules\Meds\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class SearchMedRequest extends Request
{
    public function rules()
    {
        return [
            "med_name" => "required|min:3",

		];
    }

	public function messages() {
		return [
			'med_name.required' => 'Te rugăm să introduci numele medicamentului',
			'med_name.min' => 'Te rugăm să introduci numele medicamentului',
		];
	}

    public function authorize()
    {
        return true;
    }

}
