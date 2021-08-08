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

        $data = [2,2,4,4,5,6,7];

        $startWeek =  Carbon::now()->startOfWeek()->toDateString();
        $endWeek = Carbon::now()->endOfWeek()->toDateString();

        $bills = Bill::where('created_at', '>=', $startWeek)->where('created_at','<', $endWeek. ' 23:59:59')->get();

        $groups = $bills->groupBy(function ($i) {
            return substr($i->created_at, 0, 10);
        })->map(function ($i) {

            return $i->sum('money');
        });
//        dump($groups);
//        die;

        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) use($data) {
                $row->column(6, function (Column $column) use($data) {
                    $column->row(admin_view('billChart.index', ['data' => json_encode($data)]));
                });
            });

    }
}
