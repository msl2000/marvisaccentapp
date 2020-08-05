<?php

namespace App\Http\Controllers;

use App\Http\Filters\SalesFilter;
use App\Http\Repositories\SaleRepository;
use App\Http\Repositories\SalesStatisticRepository;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Initialize the repositories to be used for this resource controller
     */
    public function __construct()
    {
        $this->repository = new SaleRepository();
        $this->statisticRepository = new SalesStatisticRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesFilter $filter)
    {
        if (request()->schema === 'statistics')
            $repository =  $this->statisticRepository;
        else
            $repository = $this->repository;

        return $repository->all($filter);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->repository->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return $this->repository->read($sale);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        return $this->repository->update($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        return $this->repository->delete($sale);
    }
}
