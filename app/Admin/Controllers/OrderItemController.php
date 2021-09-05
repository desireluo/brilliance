<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\OrderItem;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderItemController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new OrderItem(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('order_id');
            $grid->column('sku');
            $grid->column('barcode');
            $grid->column('spec');
            $grid->column('pic_url');
            $grid->column('price');
            $grid->column('num');
            $grid->column('shop_id');
            $grid->column('platform');
            $grid->column('company');
            $grid->column('bill_code');
            $grid->column('print_data');
            $grid->column('created');
            $grid->column('modified');
            $grid->column('sku_id');
            $grid->column('oid');
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
        return Show::make($id, new OrderItem(), function (Show $show) {
            $show->field('id');
            $show->field('order_id');
            $show->field('sku');
            $show->field('barcode');
            $show->field('spec');
            $show->field('pic_url');
            $show->field('price');
            $show->field('num');
            $show->field('shop_id');
            $show->field('platform');
            $show->field('company');
            $show->field('bill_code');
            $show->field('print_data');
            $show->field('created');
            $show->field('modified');
            $show->field('sku_id');
            $show->field('oid');
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
        return Form::make(new OrderItem(), function (Form $form) {
            $form->display('id');
            $form->text('order_id');
            $form->text('sku');
            $form->text('barcode');
            $form->text('spec');
            $form->text('pic_url');
            $form->text('price');
            $form->text('num');
            $form->text('shop_id');
            $form->text('platform');
            $form->text('company');
            $form->text('bill_code');
            $form->text('print_data');
            $form->text('created');
            $form->text('modified');
            $form->text('sku_id');
            $form->text('oid');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
