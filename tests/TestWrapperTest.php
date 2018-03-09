<?php

namespace EloWrapper\Tests;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class TestModel extends \EloWrapper\Models\Model
{
    //
}

class TestWrapperTest extends TestCase
{
    protected $wrapper;

    public function setUp()
    {
        $this->wrapper = new \EloWrapper\Wrappers\Test(new TestModel);
    }

    public function testPerform()
    {
        $this->assertInstanceOf(Model::class, $this->wrapper->perform());
        $this->assertEquals('Hello world', $this->wrapper->perform()->name);
    }
}