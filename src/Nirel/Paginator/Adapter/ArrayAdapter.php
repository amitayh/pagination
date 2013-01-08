<?php

namespace Nirel\Paginator\Adapter;

use Nirel\Paginator\Adapter\AdapterInterface;

class ArrayAdapter implements AdapterInterface
{

    /**
     * @var array
     */
    protected $_data;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->_data = $data;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects() {
        return count($this->_data);
    }

    /**
     * @inheritdoc
     */
    public function getObjects($offset, $limit) {
        return new \ArrayIterator(array_slice($this->_data, $offset, $limit));
    }

}
