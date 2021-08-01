<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Bill;
use App\Models\AdminUser;
use App\Models\Category;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BillController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Bill(['category', 'adminUser']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('category.title', '分类');
            $grid->column('money');
            $grid->column('paid_at');
            $grid->column('remark');
            $grid->column('adminUser.name');
            $grid->column('screenshot');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                //$categoryModel = Category::class;
                //$filter->equal('type')->options($categoryModel::selectOptions());
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
        return Show::make($id, new Bill(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('type');
            $show->field('money');
            $show->field('paid_at');
            $show->field('remark');
            $show->field('admin_user_id');
            $show->field('screenshot');
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
        return Form::make(new Bill(), function (Form $form) {
            $form->display('id');
            $categoryModel = \App\Models\Category::class;

            $form->text('name')->required();
            $form->select('type', trans('admin.parent_id'))->options($categoryModel::selectOptions())->required();

            $form->text('money')->required();
            $form->date('paid_at');
            $form->text('remark');
            $form->image('screenshot', 'screenshot');


            $form->text('admin_user_id')->display(false);
            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isCreating()) {

                }

                $form->admin_user_id = Admin::user()->id;

                // 删除用户提交的数据
                //$form->deleteInput('title');

                // 中断后续逻辑
                //return $form->response()->error('服务器出错了~');
            });
        });
    }
}
