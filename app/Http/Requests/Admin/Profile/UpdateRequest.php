<?php namespace Cryptic\Wgrpg\Http\Requests\Admin\Profile;

use Cryptic\Wgrpg\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // TODO: Check role here? But controller has middleware for that...
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Sigh, fucking unique rules...
            'email' => 'email|max:255|confirmed|unique:users,email,' . \Auth::id(),
            'current_password' => 'max:60|passcheck',
            'password' => 'min:8|max:60|confirmed',
        ];
    }
}
