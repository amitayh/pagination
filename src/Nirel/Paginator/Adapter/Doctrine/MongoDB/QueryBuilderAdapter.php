<?php

namespace Nirel\Paginator\Adapter\Doctrine\MongoDB;

use Nirel\Paginator\Adapter\AdapterInterface;
use Doctrine\MongoDB\Query\Builder as QueryBuilder;

class QueryBuilderAdapter implements AdapterInterface
{

    /**
     * @var QueryBuilder
     */
    protected $_qb;

    /**
     * @param QueryBuilder $qb
     */
    public function __construct(QueryBuilder $qb) {
        $this->_qb = $qb;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects() {
        return $this->_qb->getQuery()->count();
    }

    /**
     * @inheritdoc
     */
    public function getObjects($offset, $limit) {
        return $this->_qb->skip($offset)->limit($limit)->getQuery()->execute();
    }

}
