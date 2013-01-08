<?php

namespace Nirel\Paginator;

interface PaginatorInterface extends \Iterator
{

    /**
     * @param int $number
     * @return PageInterface
     */
    function getPage($number);

    /**
     * @return \Nirel\Paginator\Adapter\AdapterInterface
     */
    function getAdapter();

    /**
     * @return int
     */
    function getPageLimit();

    /**
     * @return int
     */
    function getNumObjects();

    /**
     * @return int
     */
    function getNumPages();

}