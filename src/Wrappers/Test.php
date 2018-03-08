<?php

namespace EloWrapper\Wrappers;

class Test extends Wrapper
{
    /**
     * Perform the wrapper action.
     *
     * @return mixed
     */
    public function perform()
    {
        $this->name = 'Hello world';

        return $this->model;
    }
}