<?php

namespace App\Http\Filters;
use App\Http\Filters\QueryFilter;
use Carbon\Carbon;

class SalesFilter extends QueryFilter {

    /**
     * @param String $dates
     */

    public function search(String $search)
    {
        $this->builder->where(function($query) use ($search) {
            $query->where('customer_name', 'LIKE', "%$search%")
            ->orWhere('product_name', 'LIKE', "%$search%")
            ->orWhere('sales_person', 'LIKE', "%$search%");
        });
    }

    /**
     * @param Array (String) $employees
     */
    public function employees(Array $employees)
    {
        $this->builder->whereHas('employee', function($query) use ($employees) {
            $query->whereIn('name', $employees);
        });
    }

     /**
     * @param Array (String) $customers
     */
    public function customers(Array $customers)
    {
        $this->builder->whereHas('customer', function($query) use ($customers) {
            $query->whereIn('full_name', $customers);
        });
    }

    /**
     * @param Array $dates
     */

    public function range(Array $dates)
    {
        $this->builder->whereBetween('date', [Carbon::parse($dates[0]), Carbon::parse($dates[1])->endOfDay()]);
    }


}