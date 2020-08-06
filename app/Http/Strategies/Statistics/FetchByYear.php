<?php

namespace App\Http\Strategies\Statistics;

use App\Http\Resources\SalesStatisticResource;
use App\Models\Sale;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class FetchByYear implements FetchStrategy
{
     /**
     * @param  null
     * @return App\Http\Resources\SalesStatisticResource
     * NOTE:
     * This class can be used when retrieving Sales Chart Statistics by the year issues in the Request. 
     * 1) Retrieves sales based on the start and end month of request date, which would be the whole year. The sales are grouped by months and prices are summed
     * 2) Creates the month labels and attach the relevant sales data to the right month label
     * Create a new SalesStatisticResource for the Frontend applcation to consume
     */
    public function fetch()
    {
        /**
         * Statistical data can be optimised using Redis to cache datacollections. Considering the dataset is not too large,
         * there was no need to implement it at this time.
         */
        // if (!$data = Redis::get($month)) {
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
