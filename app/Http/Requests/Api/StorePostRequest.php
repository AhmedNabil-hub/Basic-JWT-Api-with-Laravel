<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

	public function authorize()
	{
		if ($this->is_admin == true) {
			return true;
		}

		return false;
	}


	public function rules()
	{
		return [
			'title' => 'required|string|max:255',
			'body' => 'required|string',
			'is_admin' => 'required|in:true,false'
		];
	}
}
