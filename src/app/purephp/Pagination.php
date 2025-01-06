<?php

namespace coderaiz\app\purephp;

class Pagination
{
    private int $currentPage = 1;
    private int $start       = 0;
    private int $end         = 15;
    private int $numberOfRecordsPerPage = 15;
    private int $numberOfPages;

    public function __construct() {
    }

    public function setCurrentPage(int $page): void
    {
        $this->currentPage = $page;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function paginate(int $totalRecords): void
    {
        $this->numberOfPages = ceil($totalRecords / $this->numberOfRecordsPerPage);

        if ($this->currentPage > $this->numberOfPages) {
            $this->currentPage = $this->numberOfPages;
        }

        $this->start = ($this->currentPage * $this->numberOfRecordsPerPage - $this->numberOfRecordsPerPage);
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getEnd(): int
    {
        return $this->end;
    }

    public function setNumberOfRecordsPerPage(int $numberOfRecordsPerPage): void
    {
        $this->numberOfRecordsPerPage = $numberOfRecordsPerPage;
        $this->end = $numberOfRecordsPerPage;
    }

    public function getNumberOfRecordsPerPage(): int
    {
        return $this->numberOfRecordsPerPage;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }
}