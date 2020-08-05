<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use Filterable;
    protected $table = "sales";
    protected $perPage = 50;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_name', 'full_name');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'sales_person', 'name');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_name', 'name');
    }
}
