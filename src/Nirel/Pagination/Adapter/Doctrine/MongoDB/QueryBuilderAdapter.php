<?php

namespace Nirel\Pagination\Adapter\Doctrine\MongoDB;

use Nirel\Pagination\Adapter\AdapterInterface;
use Doctrine\MongoDB\Query\Builder as QueryBuilder;

class QueryBuilderAdapter implements AdapterInterface
{

    /**
     * @var QueryBuilder
     */
    protected $qb;

    /**
     * @param QueryBuilder $qb
     */
    public function __construct(QueryBuilder $qb)
    {
        $this->qb = $qb;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects()
    {
        return $this->qb->getQuery()->count();
    }

    /**
     * @inheritdoc
     */
    public function getObjects($offset, $limit)
    {
        return $this->qb->skip($offset)->limit($limit)->getQuery()->execute();
    }

}
