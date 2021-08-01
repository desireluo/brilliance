<?php

namespace App\Http\Actions\Category;

use App\Models\Category;
use Dcat\Admin\Tree\RowAction;

class Show extends RowAction
{
    public function handle()
    {
        $key = $this->getKey();

        $categoryModel = Category::class;
        $cateogry = $categoryModel::find($key);

        $cateogry->update(['show' => $cateogry->show ? 0 : 1]);

        return $this
            ->response()
            ->success(trans('admin.update_succeeded'))
            ->location('categories');
    }

    public function title()
    {
        $icon = $this->getRow()->show ? 'icon-eye-off' : 'icon-eye';

        return "&nbsp;<i class='feather $icon'></i>&nbsp;";
    }
}
