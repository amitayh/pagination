<?php

namespace Nirel\Pagination\Tests\Adapter;

use Nirel\Pagination\Adapter\ArrayAdapter;

class ArrayAdapterTest extends \PHPUnit_Framework_TestCase
{

    public function testGetNumObjects()
    {
        $adapter = $this->getAdapter();
        $this->assertEquals(3, $adapter->getNumObjects());
    }

    public function testGetObjects()
    {
        $adapter = $this->getAdapter();

        $data = iterator_to_array($adapter->getObjects(0, 2));
        $this->assertEquals(2, count($data));
        $this->assertEquals('Object #1', $data[0]);

        $data = iterator_to_array($adapter->getObjects(2, 1));
        $this->assertEquals('Object #3', $data[0]);
    }

    protected function getAdapter()
    {
        $data = array('Object #1', 'Object #2', 'Object #3');
        return new ArrayAdapter($data);
    }

}