<?php

namespace Nirel\Paginator;

interface PaginatorInterface extends \Iterator
{

    /**
     * @param int $number
     * @return PageInterface
     */
    public function getPage($number);

    /**
     * @return \Nirel\Paginator\Adapter\AdapterInterface
     */
    public function getAdapter();

    /**
     * @return int
     */
    public function getPageLimit();

    /**
     * @return int
     */
    public function getNumObjects();

    /**
     * @return int
     */
    public function getNumPages();

}