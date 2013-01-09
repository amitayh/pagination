<?php

namespace Nirel\Pagination\Tests\Adapter;

use Nirel\Pagination\Tests\Factory;

class ArrayAdapterTest extends \PHPUnit_Framework_TestCase
{

    public function testGetNumObjects()
    {
        $adapter = Factory::createArrayAdapter(3);
        $this->assertEquals(3, $adapter->getNumObjects());
    }

    public function testGetObjects()
    {
        $adapter = Factory::createArrayAdapter(3);

        $data = iterator_to_array($adapter->getObjects(0, 2));
        $this->assertEquals(2, count($data));
        $this->assertEquals('Object #0', $data[0]);

        $data = iterator_to_array($adapter->getObjects(2, 1));
        $this->assertEquals('Object #2', $data[0]);
    }

}