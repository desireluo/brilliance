<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Services\DateService;
use Carbon\Carbon;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class MonthGrapth extends Controller
{
    public function index(Content $content)
    {
        $allMonths = (new DateService())->getAllMonths();


        $yearStart = Carbon::now()->startOfYear()->toDateString();
        $yearEnd = Carbon::now()->endOfYear()->toDateString();

        $bills = Bill::query()->where('created_at', '>=', $yearStart)
            ->where('created_at', '<', $yearEnd. ' 23:59:59')->get();
        $groups = $bills->groupBy(function ($i) {
            return substr($i->created_at, 0, 7);
        })->map(function ($i) {
            return $i->sum('money');
        })->all();

        $datas = [];
        foreach ($allMonths as $month) {

            if(isset($groups[$month])) {
                $datas[] = $groups[$month];
            } else {
                $datas[] = 0;
            }
        }
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) use($datas) {
                $row->column(6, function (Column $column) use($datas) {
                    $column->row(admin_view('monthGrapth.index', ['data' => json_encode($datas)]));
                });
            });

    }

}
