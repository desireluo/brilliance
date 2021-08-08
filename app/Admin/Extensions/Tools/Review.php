<?php

namespace App\Admin\Extensions\Tools;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Tools\AbstractTool;

class Review extends AbstractTool
{
    protected function script()
    {
        $url = request()->fullUrlWithQuery(['gender' => '_gender_']);

        return <<<JS
$('input:radio.user-gender').change(function () {
    var url = "$url".replace('_gender_', $(this).val());
    
    var idArray = [];
$('.grid-row-checkbox').each(function() {
    
    var o = $(this).is(':checked');
    console.log('o',o);
      idArray.push($(this).data('id'));
})
    Dcat.reload(url);
});



JS;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'batch-review'   => 'Review',
        ];

        return view('admin.tools.review', compact('options'));
    }
}
