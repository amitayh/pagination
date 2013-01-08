<?php

namespace Nirel\Paginator\Adapter;

interface AdapterInterface
{

    /**
     * @return int
     */
    public function getNumObjects();

    /**
     * @param int $offset
     * @param int $limit
     * @return \Iterator
     */
    public function getObjects($offset, $limit);

}