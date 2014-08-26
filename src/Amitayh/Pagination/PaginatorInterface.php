<?php

namespace Amitayh\Pagination;

interface PaginatorInterface extends \Iterator
{

    /**
     * @param int $number
     * @return PageInterface
     */
    function getPage($number);

    /**
     * @return \Amitayh\Pagination\Adapter\AdapterInterface
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
