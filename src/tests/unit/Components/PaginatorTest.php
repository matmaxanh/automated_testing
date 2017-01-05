<?php


namespace App\tests\unit\Components;


use App\Components\Paginator;
use App\tests\TestCase;
use InvalidArgumentException;

class PaginatorTest extends TestCase
{
    /** @test */
    public function it_should_throw_invalid_argument_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Item per page & total must be an integer');

        new Paginator(10, 'abc');
    }

    /**
     * @test
     * @dataProvider shouldBeDisplayedDataProvider
     *
     * @param $itemPerPage
     * @param $total
     * @param $expected
     */
    public function it_should_be_displayed($itemPerPage, $total, $expected)
    {
        $paginator = new Paginator($itemPerPage, $total);

        $this->assertEquals($expected, $paginator->shouldBeDisplayed());
    }

    public function shouldBeDisplayedDataProvider()
    {
        return [
            'yes' => [10, 12, true],
            'no' => [10, 5, false]
        ];
    }

    /**
     * @test
     * @dataProvider totalPagesDataProvider
     *
     * @param $itemPerPage
     * @param $total
     * @param $expected
     */
    public function it_returns_total_pages($itemPerPage, $total, $expected)
    {
        $paginator = new Paginator($itemPerPage, $total);

        $this->assertEquals($expected, $paginator->totalPages());
    }

    public function totalPagesDataProvider()
    {
        return [
            'no_page' => [10, 0, 0],
            'one page' => [10, 9, 1],
            'many pages' => [10, 32, 4]
        ];
    }

    /**
     * @test
     */
    public function it_return_total_items()
    {
        $itemPerPage = 10;
        $total = 150;
        $paginator = new Paginator($itemPerPage, $total);

        $this->assertEquals(150, $paginator->total());
    }

    /**
     * @test
     */
    public function it_returns_previous_page()
    {
        $itemPerPage = 10;
        $total = 55;
        $currentPage = 2;

        $paginator = new Paginator($itemPerPage, $total, $currentPage);

        $this->assertEquals(1, $paginator->previousPage());
    }

    /**
     * @test
     */
    public function it_returns_next_page()
    {
        $itemPerPage = 10;
        $total = 55;
        $currentPage = 2;

        $paginator = new Paginator($itemPerPage, $total, $currentPage);

        $this->assertEquals(3, $paginator->nextPage());
    }

    /**
     * @test
     * @dataProvider isCurrentPageDataProvider
     *
     * @param $itemPerPage
     * @param $total
     * @param $currentPage
     * @param $pageToCheck
     * @param $expected
     */
    public function it_can_check_a_page_is_current_page($itemPerPage, $total, $currentPage, $pageToCheck, $expected)
    {
        $paginator = new Paginator($itemPerPage, $total, $currentPage);

        $this->assertEquals($expected, $paginator->isCurrentPage($pageToCheck));
    }

    public function isCurrentPageDataProvider()
    {
        return [
            'yes' => [10, 20, 2, 2, true],
            'no' => [10, 20, 2, 1, false]
        ];
    }

    /**
     * @test
     * @dataProvider isFirstPageDataProvider
     *
     * @param $itemPerPage
     * @param $total
     * @param $currentPage
     * @param $expected
     */
    public function it_can_check_current_page_is_first_page($itemPerPage, $total, $currentPage, $expected)
    {
        $paginator = new Paginator($itemPerPage, $total, $currentPage);

        $this->assertEquals($expected, $paginator->isFirstPage());
    }

    public function isFirstPageDataProvider()
    {
        return [
            'yes' => [10, 24, 1, true],
            'no' => [10, 24, 2, false]
        ];
    }

    /**
     * @test
     * @dataProvider isLastPageDataProvider
     *
     * @param $itemPerPage
     * @param $total
     * @param $currentPage
     * @param $expected
     */
    public function it_can_check_current_page_is_last_page($itemPerPage, $total, $currentPage, $expected)
    {
        $paginator = new Paginator($itemPerPage, $total, $currentPage);

        $this->assertEquals($expected, $paginator->isLastPage());
    }

    public function isLastPageDataProvider()
    {
        return [
            'yes' => [10, 24, 3, true],
            'no' => [10, 24, 1, false]
        ];
    }
}