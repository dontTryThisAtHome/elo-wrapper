<?php

namespace EloWrapper\Wrappers;

use Illuminate\Eloquent\Model;

class Wrapper
{
    /**
     * Model instance.
     *
     * @var Illuminate\Eloquent\Model
     */
    protected $model;

    /**
     * Creates a new Wrapper instance.
     *
     * @return
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method,$parameters)
    {
        return $this->model->$method(...$parameters);
    }
}