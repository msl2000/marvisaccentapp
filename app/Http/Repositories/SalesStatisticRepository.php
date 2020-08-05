<?php

namespace App\Http\Repositories;

use App\Http\Strategies\Statistics\FetchByMonth;
use App\Http\Strategies\Statistics\FetchByYear;
use App\Services\Interfaces\Repository;

class SalesStatisticRepository implements Repository
{

    public function __construct()
    {
        $this->fetchByMonth = new FetchByMonth();
        $this->fetchByYear = new FetchByYear();
    }

    public function all($filter)
    {
        if (request()->filter_by === 'month')
            $service = $this->fetchByMonth;
        else
            $service = $this->fetchByYear;

        $data = $service->fetch();

        return $data;
    }
    public function create($request)
    {
    }
    public function read($object)
    {
    }
    public function update($request, $object)
    {
    }
    public function delete($object)
    {
    }

    private function indexMonthData()
    {
    }
}
