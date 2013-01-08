<?php

namespace Nirel\Paginator\Tests;

use Nirel\Paginator\Tests\Factory;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{

    public function testGetNumPages() {
        $paginator = Factory::createPaginator(0, 5);
        $this->assertEquals(0, $paginator->getNumPages());

        $paginator = Factory::createPaginator(5, 5);
        $this->assertEquals(1, $paginator->getNumPages());

        $paginator = Factory::createPaginator(8, 5);
        $this->assertEquals(2, $paginator->getNumPages());
    }

    public function testGetNumObjects() {
        $paginator = Factory::createPaginator(8, 5);
        $this->assertEquals(8, $paginator->getNumObjects());
    }

    public function testPageNumberValidation() {
        $paginator = Factory::createPaginator(8, 5);
        try {
            $paginator->getPage(0);
        } catch (\OutOfRangeException $e) {
            try {
                $paginator->getPage(3);
            } catch (\OutOfRangeException $e) {
                return;
            }
        }
        $this->fail('An expected exception has not been raised.');
    }

    public function testIterator() {
        $paginator = Factory::createPaginator(8, 5);
        foreach ($paginator as $i => $page) {
            $this->assertEquals($i + 1, $page->getNumber());
        }
    }

}