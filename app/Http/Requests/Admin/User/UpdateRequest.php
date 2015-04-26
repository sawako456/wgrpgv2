<?php namespace Cryptic\Wgrpg\Http\Requests\Admin\User;

use Cryptic\Wgrpg\Http\Requests\Request;
use Route;

class UpdateRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'      => 'required|max:255|unique:users,username,' . $this->route('id'),
            'email'         => 'email|max:255|unique:users,email,' . $this->route('id'),
            'roles'         => 'array|min:1',
            'created_at'    => 'required|date|date_format:Y-m-d H:i:s',
            'updated_at'    => 'required|date|date_format:Y-m-d H:i:s',
            'last_login_at' => 'date|date_format:Y-m-d H:i:s',
            'logins'        => 'integer|min:0',
        ];
    }

    /**
     * Get the "each" rules.
     *
     * @return array
     */
    public function eachRules()
    {
        return [
            'roles' => [
                'integer',
                'exists:roles,id',
            ],
        ];
    }
}
