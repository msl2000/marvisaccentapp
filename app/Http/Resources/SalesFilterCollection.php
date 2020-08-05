<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SalesFilterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employees' => new EmployeeFilterCollection(Employee::all()->unique('name')->sortBy('name')),
            'customers' => new CustomerFilterCollection(Customer::all()->unique('full_name')->sortBy('full_name')),
        
        ];
    }
}
