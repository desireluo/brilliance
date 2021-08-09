<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\ReleasePost;
use App\Admin\Extensions\Tools\Review;
use App\Admin\Extensions\Tools\UserGender;
use App\Admin\Repositories\Bill;
use App\Models\AdminUser;
use App\Models\Category;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Support\Helper;

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
            $grid->column('screenshot')->display(function ($pictures) {

                return json_decode($pictures, true);

            })->image('', 100);

            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                //$categoryModel = Category::class;
                //$filter->equal('type')->options($categoryModel::selectOptions());
            });

            $grid->batchActions([
                new ReleasePost('发布文章', 1),
                new ReleasePost('文章下线', 0)
            ]);
            $grid->setActionClass(Grid\Displayers\Actions::class);

            $grid->tools(new Review());
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
            $show->field('screenshot')->image();
//            $show->field('created_at');
//            $show->field('updated_at');
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
            //$form->display('id');
            $categoryModel = \App\Models\Category::class;

            $form->text('name')->required();
            $form->select('type', '分类')->options($categoryModel::selectOptions())->required();

            $form->text('money')->required();
            $form->date('paid_at');
            $form->text('remark');
            $form->multipleImage('screenshot', 'screenshot')->saving(function ($paths) {

                $paths = Helper::array($paths);
                return json_encode($paths);
            })->customFormat(function ($paths) {

                // 转为数组
                return Helper::array($paths);
            });


            $form->text('admin_user_id')->display(false);

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
