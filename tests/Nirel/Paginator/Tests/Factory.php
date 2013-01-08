<?php

namespace Nirel\Paginator\Tests;

use Nirel\Paginator\Adapter\ArrayAdapter;
use Nirel\Paginator\Paginator;

class Factory
{

    /**
     * @param int $numObjects
     * @param int $perPage
     * @return Paginator
     */
    public static function createPaginator($numObjects, $perPage)
    {
        $data = array();
        for ($i = 0; $i < $numObjects; $i++) {
            $data[] = "Object #$i";
        }
        $paginatable = new ArrayAdapter($data);
        return new Paginator($paginatable, $perPage);
    }

}