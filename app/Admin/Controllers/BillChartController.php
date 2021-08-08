<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillChart;
use Carbon\Carbon;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class BillChartController extends Controller
{
    public function index(Content $content)
    {

        $startWeek =  Carbon::now()->startOfWeek()->toDateString();
        $endWeek = Carbon::now()->endOfWeek()->toDateString();
        $oneDayAdd = Carbon::parse($startWeek)->addDay(1)->toDateString();
        $dayNext = Carbon::parse($startWeek)->addDay(2)->toDateString();
        $day3 = Carbon::parse($startWeek)->addDay(3)->toDateString();
        $day4 = Carbon::parse($startWeek)->addDay(4)->toDateString();
        $day5 = Carbon::parse($startWeek)->addDay(5)->toDateString();

        $bills = Bill::where('created_at', '>=', $startWeek)->where('created_at','<', $endWeek. ' 23:59:59')->get();

        $data = $bills->groupBy(function ($i) {
            return substr($i->created_at, 0, 10);
        })->map(function ($i) {

            return $i->sum('money');
        })->all();

        $datas = [];
        foreach ([$startWeek,$oneDayAdd,$dayNext, $day3,$day4,$day5, $endWeek] as $item) {

            if(isset($data[$item])) {

                $datas[] = $data[$item];
            } else {

                $datas[] = 0;
            }

        }


        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) use($datas) {
                $row->column(6, function (Column $column) use($datas) {
                    $column->row(admin_view('billChart.index', ['data' => json_encode($datas)]));
                });
            });

    }
}
