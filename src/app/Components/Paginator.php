<?php


namespace App\Components;


use InvalidArgumentException;

class Paginator
{
    /**
     * @var int
     */
    private $itemPerPage;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * Paginator constructor.
     *
     * @param $itemPerPage
     * @param $total
     * @param int $currentPage
     */
    public function __construct($itemPerPage, $total, $currentPage = 1)
    {
        $itemPerPage = $itemPerPage ?: config('app.pagination.item_per_page');

        if (!is_int($itemPerPage) || !is_int($total)) {
            throw new InvalidArgumentException('Item per page & total must be an integer');
        }

        $this->itemPerPage = (int)$itemPerPage;
        $this->total = (int)$total;
        $this->currentPage = (int)$currentPage;
    }

    /**
     * If number of page is less than 1 then pagination should not be displayed
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return $this->totalPages() > 1;
    }

    /**
     * Return number of pages
     *
     * @return int
     */
    public function totalPages()
    {
        return (int)ceil($this->total / $this->itemPerPage);
    }

    /**
     * @return int
     */
    public function total()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function previousPage()
    {
        return $this->currentPage - 1;
    }

    /**
     * @return int
     */
    public function nextPage()
    {
        return $this->currentPage + 1;
    }

    /**
     * @param int $page
     *
     * @return bool
     */
    public function isCurrentPage($page)
    {
        return $this->currentPage === $page;
    }

    /**
     * Check current page is first page or not
     *
     * @return bool
     */
    public function isFirstPage()
    {
        return $this->currentPage === 1;
    }

    /**
     * Check current page is last page or not
     *
     * @return bool
     */
    public function isLastPage()
    {
        return $this->currentPage === $this->totalPages();
    }
}
