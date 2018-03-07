<?php

namespace Dontrythisathome\EloWrapper;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $attributes)
    {
        if ($class = config('actions')[get_class($this)][$method]??null){
            return (new $class($this))->perform(...$attributes);
        }

        return parent::__call($method, $attributes);
    }
}