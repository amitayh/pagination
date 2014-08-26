<?php

namespace Amitayh\Pagination\Adapter;

interface AdapterInterface
{

    /**
     * @return int
     */
    function getNumObjects();

    /**
     * @param int $offset
     * @param int $limit
     * @return \Iterator
     */
    function getObjects($offset, $limit);

}
