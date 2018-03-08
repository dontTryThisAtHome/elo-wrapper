<?php

namespace EloWrapper\Models;

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
        if (!$wrapper = $this->resolveWrapper($method)){
            return parent::__call($method, $attributes);
        }

        return $wrapper->perform(...$attributes);
    }

    /**
     * Resolve the wrapper.
     *
     * @param  string $method
     * @return mixed
     */
    protected function resolveWrapper(string $method)
    {
        if (!$className = $this->resolveWrapperClassName($method)) return;

        return app()->makeWith($className,['model'=>$this]);
    }

    /**
     * Resolve the wrapper class name.
     *
     * @param  string $method
     * @return string
     */
    protected function resolveWrapperClassName(string $method)
    {
        return config('wrapper.'.get_class($this).'.'.$method);
    }
}