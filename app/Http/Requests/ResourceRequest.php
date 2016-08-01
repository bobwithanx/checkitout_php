<?php

namespace App\Http\Requests;


class ResourceRequest extends Request
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required',
			'inventory_tag' => 'required',
			'category_id' => 'required'
		];
	}
}
