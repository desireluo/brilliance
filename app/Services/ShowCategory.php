<?php

namespace App\Services;

class ShowCategory
{

    public $testData = [

        [
            'id' => 1,
            'pid' => 0,
            'name' => 'a',
        ],
        [
            'id' => 2,
            'pid' => 1,
            'name' => 'b',

        ],[
            'id' => 3,
            'pid' => 2,
            'name' => 'c',
        ]
    ];

    public function getTree($arr, $pid = 0, $level = 0)
    {
        static $list = [];
        foreach ($arr as $key => $value) {
            if ($value["pid"] == $pid) {
                $value["level"] = $level;
                $list[] = $value;
                unset($arr[$key]); //删除已经排好的数据为了减少遍历的次数，当然递归本身就很费神就是了
                $this->getTree($arr, $value["id"], $level + 1);
            }
        }
        return $list;

    }

}
