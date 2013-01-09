<?php

namespace Nirel\Pagination\Tests;

use Nirel\Pagination\Adapter\ArrayAdapter;
use Nirel\Pagination\Paginator;

class Factory
{

    /**
     * @param int $numObjects
     * @param int $perPage
     * @return Paginator
     */
    public static function createPaginator($numObjects, $perPage)
    {
        $adapter = self::createArrayAdapter($numObjects);
        return new Paginator($adapter, $perPage);
    }

    /**
     * @param int $numObjects
     * @return ArrayAdapter
     */
    public static function createArrayAdapter($numObjects)
    {
        $data = array();
        for ($i = 0; $i < $numObjects; $i++) {
            $data[] = "Object #$i";
        }
        return new ArrayAdapter($data);
    }

}