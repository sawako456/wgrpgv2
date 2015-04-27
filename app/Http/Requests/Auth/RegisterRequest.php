<?php namespace Cryptic\Wgrpg\Http\Requests\Auth;

use Cryptic\Wgrpg\Http\Requests\Request;

class RegisterRequest extends Request
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
            'username' => 'required|max:255|unique:users,username',
            'email'    => 'email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255|confirmed', // TODO: Password pattern?
        ];
    }
}
