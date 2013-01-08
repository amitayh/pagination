<?php

namespace Nirel\Paginator;

interface PageInterface extends \IteratorAggregate, \Countable
{

    /**
     * @return int
     */
    public function getNumber();

    /**
     * @return bool
     */
    public function isFirst();

    /**
     * @return bool
     */
    public function isLast();

    /**
     * @return bool
     */
    public function hasPrev();

    /**
     * @return int
     */
    public function prevPageNum();

    /**
     * @return bool
     */
    public function hasNext();

    /**
     * @return int
     */
    public function nextPageNum();

    /**
     * @return int
     */
    public function getStartIndex();

    /**
     * @return int
     */
    public function getEndIndex();

    /**
     * @param int $tail
     * @return array
     */
    public function getSlidingPaginationRange($tail);

}