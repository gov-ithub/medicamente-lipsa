<?php namespace Modules\Meds\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class SubscribeMedRequest extends Request
{
    public function rules()
    {
        return [
//            "first_name" => "required|min:2",
//            "last_name" => "required|min:2",
			'email' => 'required|email',
		];
    }

//	public function messages() {
//		return [];
//	}

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
