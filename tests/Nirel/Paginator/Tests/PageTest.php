<?php

namespace Nirel\Paginator\Tests;

use Nirel\Paginator\Tests\Factory;

class PageTest extends \PHPUnit_Framework_TestCase
{

    public function testPageHelperMethods()
    {
        $paginator = Factory::createPaginator(8, 5);

        $page = $paginator->getPage(1);
        $this->assertTrue($page->isFirst());
        $this->assertTrue($page->hasNext());
        $this->assertEquals(2, $page->nextPageNum());
        $this->assertEquals(1, $page->getStartIndex());
        $this->assertEquals(5, $page->getEndIndex());
        $this->assertEquals(5, $page->count());

        $page = $paginator->getPage(2);
        $this->assertTrue($page->isLast());
        $this->assertTrue($page->hasPrev());
        $this->assertEquals(1, $page->prevPageNum());
        $this->assertEquals(6, $page->getStartIndex());
        $this->assertEquals(8, $page->getEndIndex());
        $this->assertEquals(3, $page->count());
    }

    public function testIterator()
    {
        $paginator = Factory::createPaginator(8, 5);
        $page = $paginator->getPage(1);
        foreach ($page as $key => $object) {
            $this->assertEquals("Object #$key", $object);
        }
    }

}