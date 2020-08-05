<?php

namespace App\Http\Strategies\Statistics;

use App\Http\Resources\SalesStatisticResource;
use App\Models\Sale;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FetchByMonth implements FetchStrategy
{
    public function fetch()
    {
        /**
         * Statistical data can be optimised using Redis to cache datacollections. Considering the dataset is not too large,
         * there was no need to implement it at this time.
         */
        // if (!$data = Redis::get($month)) {
        $sales = Sale::select(
            DB::raw('ROUND(sum(price), 2) as sums'),
            // DB::raw("DATE_FORMAT(date,'%M %Y') as months")
            DB::raw("date")
        )
            ->whereBetween('date', [Carbon::parse(request()->date)->startOfMonth(), Carbon::parse(request()->date)->endOfMonth()])
            ->join('products', 'products.name', '=', 'sales.product_name')
            ->groupBy('date')
            ->get();

        $data = [];
        $dates = [];
        $period = CarbonPeriod::create(Carbon::parse(request()->date)->startOfMonth(), Carbon::parse(request()->date)->endOfMonth());
        foreach ($period as $date) {
            $sale = $sales->where('date', $date->format('Y-m-d'))->first();
            $dates[] = $date->format('M d');
            $data[] = $sale ? $sale->sums : 0;
        }

        return new SalesStatisticResource(collect([
            'labels' => $dates,
            'data' => $data
        ]));
        // }
    }
}
