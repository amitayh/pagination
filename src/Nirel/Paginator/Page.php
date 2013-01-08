<?php

namespace Nirel\Paginator;

class Page implements \IteratorAggregate, \Countable
{

    /**
     * @var Paginator
     */
    protected $_paginator;

    /**
     * @var int
     */
    protected $_number;

    /**
     * @param Paginator $paginator
     * @param int $number
     */
    public function __construct(Paginator $paginator, $number) {
        $this->_paginator = $paginator;
        $this->_number = $number;
    }

    /**
     * @return int
     */
    public function getNumber() {
        return $this->_number;
    }

    /**
     * @return bool
     */
    public function isFirst() {
        return ($this->_number == 1);
    }

    /**
     * @return bool
     */
    public function isLast() {
        return ($this->_number == $this->_paginator->getNumPages());
    }

    /**
     * @return bool
     */
    public function hasPrev() {
        return ($this->_number > 1);
    }

    /**
     * @return int
     */
    public function prevPageNum() {
        return $this->_paginator->validatePageNum($this->_number - 1);
    }

    /**
     * @return bool
     */
    public function hasNext() {
        return ($this->_number < $this->_paginator->getNumPages());
    }

    /**
     * @return int
     */
    public function nextPageNum() {
        return $this->_paginator->validatePageNum($this->_number + 1);
    }

    /**
     * @return int
     */
    public function getStartIndex() {
        return ($this->_paginator->getPageLimit() * ($this->_number - 1)) + 1;
    }

    /**
     * @return int
     */
    public function getEndIndex() {
        return $this->getStartIndex() + $this->count() - 1;
    }

    /**
     * @param int $tail
     * @return array
     */
    public function getSlidingPaginationRange($tail = 3) {
        $current = $this->_number;
        $numPages = $this->_paginator->getNumPages();
        $low = $current - $tail;
        $high = $current + $tail;
        if ($low < 1) {
            $offset = 1 - $low;
            $low += $offset;
            $high += $offset;
        }
        if ($high > $numPages) {
            $offset = $high - $numPages;
            $low -= $offset;
            $high -= $offset;
        }
        $low = max(1, $low);
        $high = min($numPages, $high);
        return range($low, $high);
    }

    /**
     * @inheritdoc
     */
    public function getIterator() {
        $paginator = $this->_paginator;
        $source = $paginator->getAdapter();
        $limit = $paginator->getPageLimit();
        $offset = ($this->_number - 1) * $limit;
        return $source->getObjects($offset, $limit);
    }

    /**
     * @inheritdoc
     */
    public function count() {
        $current = $this->_number;
        $paginator = $this->_paginator;
        $pageLimit = $paginator->getPageLimit();
        $numPages = $paginator->getNumPages();
        if ($current == $numPages) {
            return $paginator->getNumObjects() - ($pageLimit * ($current - 1));
        } else {
            return $pageLimit;
        }
    }

}