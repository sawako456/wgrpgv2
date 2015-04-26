<?php namespace Cryptic\Wgrpg\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;

abstract class Request extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    public function validator(ValidationFactory $factory)
    {
        $validator = $factory->make($this->all(), $this->rules());

        if (method_exists($this, 'eachRules')) {
            $rules = $this->eachRules();

            foreach ($rules as $field => $rules) {
                $validator->each($field, $rules);
            }
        }

        return $validator;
    }
}
