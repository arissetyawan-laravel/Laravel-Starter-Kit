<?php

namespace App\Http\Requests\Users\Roles;

use App\Http\Requests\Request;

class UpdateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->user()->can('manage_role_permissions');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|max:60|unique:roles_permissions,name,' . $this->segment(2),
			'label' => 'required|max:60',
		];
	}

}
