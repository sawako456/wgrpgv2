<?php namespace Cryptic\Wgrpg\Validation;

use Auth;
use Hash;
use Illuminate\Validation\Validator as IlluminateValidator;

class Validator extends IlluminateValidator
{
    /**
     * Validate that the given password exists in the database.
     * TODO: Inject Auth and Hash into constructor
     *
     * @param string                           $attribute
     * @param string                           $value
     * @param array                            $parameters
     * @param \Illuminate\Validation\Validator $validator
     *
     * @return bool
     */
    public function validatePasscheck($attribute, $value, $parameters, $validator)
    {
        return Hash::check($value, Auth::user()->getAuthPassword());
    }
}
