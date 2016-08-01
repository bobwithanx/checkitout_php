<?php

namespace App\Http\Requests;


class StudentRequest extends Request
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'id_number' => 'required'
		];
	}
}
