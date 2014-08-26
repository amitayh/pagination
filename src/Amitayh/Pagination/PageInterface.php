<?php

namespace Amitayh\Pagination;

interface PageInterface extends \IteratorAggregate, \Countable
{

    /**
     * @return int
     */
    function getNumber();

    /**
     * @return bool
     */
    function isFirst();

    /**
     * @return bool
     */
    function isLast();

    /**
     * @return bool
     */
    function hasPrev();

    /**
     * @return int
     */
    function prevPageNum();

    /**
     * @return bool
     */
    function hasNext();

    /**
     * @return int
     */
    function nextPageNum();

    /**
     * @return int
     */
    function getStartIndex();

    /**
     * @return int
     */
    function getEndIndex();

    /**
     * @param int $tail
     * @return array
     */
    function getSlidingPaginationRange($tail = 3);

}
