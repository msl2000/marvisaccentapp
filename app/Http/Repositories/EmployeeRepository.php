<?php

namespace App\Http\Repositories;

use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use App\Models\Sale;
use App\Services\Interfaces\Repository;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements Repository
{
    public function all($filter)
    {
        $employees = Employee::get()->unique('name');

        foreach ($employees as $employee) {
            $employee->sums = Sale::select(
                DB::raw('ROUND(sum(price), 2) as sums'),
                DB::raw('sales_person')
            )
                ->where('sales_person', $employee->name)
                ->join('products', 'products.name', '=', 'sales.product_name')
                ->groupBy('sales_person')
                ->first()->sums;
        };

        $employees = $employees->sortByDesc('sums');
        return new EmployeeCollection($employees);
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
}
