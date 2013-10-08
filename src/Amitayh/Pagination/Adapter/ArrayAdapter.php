<?php

namespace Amitayh\Pagination\Adapter;

use Amitayh\Pagination\Adapter\AdapterInterface;

class ArrayAdapter implements AdapterInterface
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects()
    {
        return count($this->data);
    }

    /**
     * @inheritdoc
     */
    public function getObjects($offset, $limit)
    {
        return new \ArrayIterator(array_slice($this->data, $offset, $limit));
    }

}
