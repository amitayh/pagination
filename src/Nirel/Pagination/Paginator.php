<?php

namespace Nirel\Pagination;

use Nirel\Pagination\Adapter\AdapterInterface;

class Paginator implements PaginatorInterface
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var int
     */
    protected $numObjects;

    /**
     * @var int
     */
    protected $numPages;

    /**
     * @var int
     */
    protected $cursor;

    /**
     * @var bool
     */
    protected $allowEmptyFirstPage;

    /**
     * @param AdapterInterface $adapter
     * @param int $perPage
     * @param bool $allowEmptyFirstPage
     */
    public function __construct(AdapterInterface $adapter, $perPage, $allowEmptyFirstPage = true)
    {
        $this->adapter = $adapter;
        $this->perPage = $perPage;
        $this->allowEmptyFirstPage = $allowEmptyFirstPage;
    }

    /**
     * @param int $number
     * @return int
     * @throws \OutOfRangeException
     */
    public function validatePageNum($number)
    {
        $number = (int) $number;
        if ($number < 1) {
            throw new \OutOfRangeException('Page number is less than 1');
        } elseif ($number > $this->getNumPages()) {
            if ($number != 1 || !$this->allowEmptyFirstPage) {
                throw new \OutOfRangeException('Empty page');
            }
        }
        return $number;
    }

    /**
     * @inheritdoc
     */
    public function getPage($number)
    {
        return new Page($this, $this->validatePageNum($number));
    }

    /**
     * @inheritdoc
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @inheritdoc
     */
    public function getPageLimit()
    {
        return $this->perPage;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects()
    {
        if ($this->numObjects === null) {
            $this->numObjects = $this->adapter->getNumObjects();
        }
        return $this->numObjects;
    }

    /**
     * @inheritdoc
     */
    public function getNumPages()
    {
        if ($this->numPages === null) {
            $this->numPages = (int) ceil($this->getNumObjects() / $this->perPage);
        }
        return $this->numPages;
    }

    /**
     * @inheritdoc
     */
    public function current()
    {
        return $this->getPage($this->cursor + 1);
    }

    /**
     * @inheritdoc
     */
    public function next()
    {
        $this->cursor++;
    }

    /**
     * @inheritdoc
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * @inheritdoc
     */
    public function valid()
    {
        return ($this->cursor < $this->getNumPages());
    }

    /**
     * @inheritdoc
     */
    public function rewind()
    {
        $this->cursor = 0;
    }

}