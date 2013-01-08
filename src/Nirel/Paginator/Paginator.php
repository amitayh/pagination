<?php

namespace Nirel\Paginator;

use Nirel\Paginator\Adapter\AdapterInterface;

class Paginator implements PaginatorInterface
{

    /**
     * @var AdapterInterface
     */
    protected $_adapter;

    /**
     * @var int
     */
    protected $_perPage;

    /**
     * @var int
     */
    protected $_numObjects;

    /**
     * @var int
     */
    protected $_numPages;

    /**
     * @var int
     */
    protected $_cursor;

    /**
     * @var bool
     */
    protected $_allowEmptyFirstPage;

    /**
     * @param AdapterInterface $adapter
     * @param int $perPage
     * @param bool $allowEmptyFirstPage
     */
    public function __construct(AdapterInterface $adapter, $perPage, $allowEmptyFirstPage = true) {
        $this->_adapter = $adapter;
        $this->_perPage = $perPage;
        $this->_allowEmptyFirstPage = $allowEmptyFirstPage;
    }

    /**
     * @param int $number
     * @return int
     * @throws \OutOfRangeException
     */
    public function validatePageNum($number) {
        $number = (int) $number;
        if ($number < 1) {
            throw new \OutOfRangeException('Page number is less than 1');
        } elseif ($number > $this->getNumPages()) {
            if ($number != 1 || !$this->_allowEmptyFirstPage) {
                throw new \OutOfRangeException('Empty page');
            }
        }
        return $number;
    }

    /**
     * @inheritdoc
     */
    public function getPage($number) {
        return new Page($this, $this->validatePageNum($number));
    }

    /**
     * @inheritdoc
     */
    public function getAdapter() {
        return $this->_adapter;
    }

    /**
     * @inheritdoc
     */
    public function getPageLimit() {
        return $this->_perPage;
    }

    /**
     * @inheritdoc
     */
    public function getNumObjects() {
        if ($this->_numObjects === null) {
            $this->_numObjects = $this->_adapter->getNumObjects();
        }
        return $this->_numObjects;
    }

    /**
     * @inheritdoc
     */
    public function getNumPages() {
        if ($this->_numPages === null) {
            $this->_numPages = (int) ceil($this->getNumObjects() / $this->_perPage);
        }
        return $this->_numPages;
    }

    /**
     * @inheritdoc
     */
    public function current() {
        return $this->getPage($this->_cursor + 1);
    }

    /**
     * @inheritdoc
     */
    public function next() {
        $this->_cursor++;
    }

    /**
     * @inheritdoc
     */
    public function key() {
        return $this->_cursor;
    }

    /**
     * @inheritdoc
     */
    public function valid() {
        return ($this->_cursor < $this->getNumPages());
    }

    /**
     * @inheritdoc
     */
    public function rewind() {
        $this->_cursor = 0;
    }

}