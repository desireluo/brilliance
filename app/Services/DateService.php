<?php

namespace App\Services;

class DateService
{

    public function getAllMonths()
    {
        $year = date('Y');
        $jan = $year. '-01';
        $feb = $year. '-02';
        $mar = $year. '-03';
        $aprial = $year. '-04';
        $may = $year. '-05';
        $jun = $year. '-06';
        $july = $year. '-07';
        $august = $year. '-08';
        $september = $year. '-09';
        $october = $year. '-10';
        $november = $year. '-11';
        $december = $year. '-12';

        return [
            $jan,$feb,$mar,$aprial,$may,$jun, $july,$august,$september,$october,$november,$december
        ];
    }

}
