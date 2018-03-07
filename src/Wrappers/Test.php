<?php

namespace EloWrapper;

class Test extends Wrapper
{
    /**
     * Perform wrapper action.
     *
     * @return mixed
     */
    public function perform()
    {
        return $this->newModelInstance(['name'=>'Hello world!']);
    }
}