<?php namespace Modules\Meds\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class EditMedRequest extends Request
{
    public function rules()
    {
        return [
            "first_name" => "required|min:2",
            "last_name" => "required|min:2",
            "address" => "required",
            "phone" => 'required|digits:10',
           // "alt_phone" => 'required|digits:10',
			'email' => 'required|email',
            "role" => "required",
            "contact.phone" => 'digits:10',
			'contact.email' => 'email',
            "med.category" => "required",
            "med.name" => "required",
            "med.active_sub" => "required",
            "med.dosage" => "required",
            "med.package" => "required",
            "med.qty" => "required",
            //"med.urgent" => "required",
            "med.manufacturer" => "required",
            "recipe.required" => "required",
            "recipe.issued_by" => "required_if:recipe.required,1",
            "recipe.doctor" => "required_if:recipe.required,1",
            "recipe.phone" => "required_if:recipe.required,1|digits:10",
//			'g-recaptcha-response' => 'required|recaptcha',
		];
    }

	public function messages() {
		return [];
	}

    public function authorize()
    {
        return true;
    }

	public function sanitize()
	{
		$input = $this->all();
		foreach ($input as $key => $value) {
			if(preg_match("/phone/", $key, $out)) {
				$input[$key] = preg_replace("/\D+/", "", $input[$key]);
			} elseif(is_array($input[$key])) {
				foreach ($input[$key] as $key2 => $value2) {
					if(preg_match("/phone/", $key2, $out2)) {
						$input[$key][$key2] = preg_replace("/\D+/", "", $input[$key][$key2]);
					}
				}
			}
		}
//		if(isset($input['phone']))
//			$input['phone'] = preg_replace("/\D+/", "", $input['phone']);
		$this->replace($input);
		return $this->all();
	}
}
