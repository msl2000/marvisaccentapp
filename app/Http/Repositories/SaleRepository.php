<?php

namespace App\Http\Repositories;

use App\Http\Resources\SaleCollection;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use App\Services\Interfaces\Repository;

class SaleRepository implements Repository
{
    public function all($filter)
    {
        return new SaleCollection(
            Sale::filter($filter)->paginate()
        );
    }
    public function create($request)
    {
    }
    public function read($sale)
    {
        $sale = $sale->load(['product']);
        return new SaleResource($sale);
    }
    public function update($request, $sale)
    {
    }
    public function delete($sale)
    {
        $sale->delete();
        return response(null, 204); //Returns 204 no-content
    }
}
