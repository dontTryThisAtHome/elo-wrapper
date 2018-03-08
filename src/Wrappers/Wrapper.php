<?php

namespace EloWrapper\Wrappers;

use Illuminate\Database\Eloquent\Model;

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
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
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

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param string $parameter
     * @return miixed
     */
    public function __get($parameter)
    {
        return $this->model->$parameter;
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param string $parameter
     * @param mixed $value
     * @return this instance
     */
    public function __set($parameter,$value)
    {
        $this->model->$parameter = $value;

        return $this;
    }
}