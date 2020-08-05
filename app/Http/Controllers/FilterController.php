<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesFilterCollection;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FilterController extends Controller
{
    public function index() {
        return new SalesFilterCollection(collect());
    }
}
