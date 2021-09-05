<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{

    public function create(Content $content)
    {
        return $content->body(admin_view('orders.create'));

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('state');
            $grid->column('city');
            $grid->column('district');
            $grid->column('address');
            $grid->column('mobile');
            $grid->column('price');
            $grid->column('specification');
            $grid->column('created');
            $grid->column('modified');
            $grid->column('phone');
            $grid->column('platform');
            $grid->column('barcode');
            $grid->column('custom_id');
            $grid->column('buyer_nick');
            $grid->column('shop_id');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Order(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('state');
            $show->field('city');
            $show->field('district');
            $show->field('address');
            $show->field('mobile');
            $show->field('price');
            $show->field('specification');
            $show->field('created');
            $show->field('modified');
            $show->field('phone');
            $show->field('platform');
            $show->field('barcode');
            $show->field('custom_id');
            $show->field('buyer_nick');
            $show->field('shop_id');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Order(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('state');
            $form->text('city');
            $form->text('district');
            $form->text('address');
            $form->text('mobile');
            $form->text('price');
            $form->text('specification');
            $form->text('created');
            $form->text('modified');
            $form->text('phone');
            $form->text('platform');
            $form->text('barcode');
            $form->text('custom_id');
            $form->text('buyer_nick');
            $form->text('shop_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
