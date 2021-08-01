<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form as WidgetForm;

class CategoryController extends AdminController
{

    /**
     * @return \Dcat\Admin\Tree
     */
    protected function treeView()
    {

        return new Tree(new \App\Models\Category(), function (Tree $tree) {
            $tree->disableCreateButton();
            $tree->disableQuickCreateButton();
            $tree->disableEditButton();
            $tree->maxDepth(3);

            $tree->actions(function (Tree\Actions $actions) {
                if ($actions->getRow()->extension) {
                    $actions->disableDelete();
                }

                $actions->prepend(new \App\Http\Actions\Category\Show());
            });

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

                if (! isset($branch['children'])) {
                    if (url()->isValidUrl($branch['uri'])) {
                        $uri = $branch['uri'];
                    } else {
                        $uri = admin_base_path($branch['uri']);
                    }

                    //$payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
                }

                return $payload;
            });
        });
    }

    public function index(Content $content)
    {

        return $content->body(function (Row $row) {
            $row->column(7, $this->treeView()->render());
            $row->column(5, function (Column $column) {
                $form = new WidgetForm();
                $form->action(admin_url('categories'));

                $categoryModel = \App\Models\Category::class;

                $form->select('parent_id', trans('admin.parent_id'))->options($categoryModel::selectOptions());
                $form->text('title', trans('admin.title'))->required();
                $form->icon('icon', trans('admin.icon'))->help($this->iconHelp());
                $form->width(9, 2);
                $column->append(Box::make(trans('admin.new'), $form));
            });
        });


    }

    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }

    public function store()
    {
        return $this->form()->saving(function (Form $form) {
            $form->input('admin_user_id', Admin::user()->id);
        })->store();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(['adminUser']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('parent_id');
            $grid->column('adminUser.username');
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
        return Show::make($id, new Category(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('parent_id');
            $show->field('admin_user_id');
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
        return Form::make(new Category(), function (Form $form) {
            $form->display('id');
            $categoryModel = \App\Models\Category::class;

            $form->select('parent_id', '顶级')->options($categoryModel::selectOptions());
            $form->text('title', '类目名称')->required();
            $form->text('admin_user_id')->display(false);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

}
