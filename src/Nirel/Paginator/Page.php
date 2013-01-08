<?php

namespace Nirel\Paginator;

class Page implements PageInterface
{

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @var int
     */
    protected $number;

    /**
     * @param Paginator $paginator
     * @param int $number
     */
    public function __construct(Paginator $paginator, $number)
    {
        $this->paginator = $paginator;
        $this->number = $number;
    }

    /**
     * @inheritdoc
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @inheritdoc
     */
    public function isFirst()
    {
        return ($this->number == 1);
    }

    /**
     * @inheritdoc
     */
    public function isLast()
    {
        return ($this->number == $this->paginator->getNumPages());
    }

    /**
     * @inheritdoc
     */
    public function hasPrev()
    {
        return ($this->number > 1);
    }

    /**
     * @inheritdoc
     */
    public function prevPageNum()
    {
        return $this->paginator->validatePageNum($this->number - 1);
    }

    /**
     * @inheritdoc
     */
    public function hasNext()
    {
        return ($this->number < $this->paginator->getNumPages());
    }

    /**
     * @inheritdoc
     */
    public function nextPageNum()
    {
        return $this->paginator->validatePageNum($this->number + 1);
    }

    /**
     * @inheritdoc
     */
    public function getStartIndex()
    {
        return ($this->paginator->getPageLimit() * ($this->number - 1)) + 1;
    }

    /**
     * @inheritdoc
     */
    public function getEndIndex()
    {
        return $this->getStartIndex() + $this->count() - 1;
    }

    /**
     * @inheritdoc
     */
    public function getSlidingPaginationRange($tail = 3)
    {
        $current = $this->number;
        $numPages = $this->paginator->getNumPages();
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
    public function getIterator()
    {
        $paginator = $this->paginator;
        $source = $paginator->getAdapter();
        $limit = $paginator->getPageLimit();
        $offset = ($this->number - 1) * $limit;
        return $source->getObjects($offset, $limit);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        $current = $this->number;
        $paginator = $this->paginator;
        $pageLimit = $paginator->getPageLimit();
        $numPages = $paginator->getNumPages();
        if ($current == $numPages) {
            return $paginator->getNumObjects() - ($pageLimit * ($current - 1));
        } else {
            return $pageLimit;
        }
    }

}