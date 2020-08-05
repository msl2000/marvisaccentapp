<?php

namespace App\Http\Strategies\Statistics;

use App\Http\Resources\SalesStatisticResource;
use App\Models\Sale;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class FetchByYear implements FetchStrategy
{
    public function fetch()
    {
        // if (!$data = Cache::get($month)) {
        $sales = Sale::select(
            DB::raw('ROUND(sum(price), 2) as sums'),
            DB::raw("DATE_FORMAT(date,'%M %Y') as months")
        )
            ->whereBetween('date', [Carbon::parse(request()->date)->startOfYear(), Carbon::parse(request()->date)->endOfYear()])
            ->join('products', 'products.name', '=', 'sales.product_name')
            ->groupBy('months')
            ->get();

        $data = [];
        $dates = [];
        $months = [];
        $start = Carbon::parse(request()->date)->startOfYear();
        $end   = Carbon::parse(request()->date)->endOfYear();
        do {
            $months[] = $start->format('F Y');
        } while ($start->addMonth() <= $end);

        foreach ($months as $date) {
            $sale = $sales->where('months', $date)->first();
            $dates[] = Carbon::parse($date)->format('M Y');
            $data[] = $sale ? $sale->sums : 0;
        }



        return new SalesStatisticResource(collect([
            'labels' => $dates,
            'data' => $data
        ]));
    }
}
