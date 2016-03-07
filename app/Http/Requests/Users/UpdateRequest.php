<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('manage_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6',
            'username' => 'required|alpha_dash|min:4|unique:users,username,' . $this->segment(2),
            'email' => 'required|email|unique:users,email,' . $this->segment(2),
            'role' => 'required|array',
            'password' => 'required_with:password_confirmation|between:6,15|confirmed',
            'password_confirmation' => 'required_with:password',
        ];
    }
}
