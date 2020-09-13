<?php

namespace App\Admin\Controllers;

use App\Models\Dorm;
use App\Models\School;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DormController extends AdminController
{
    protected $title = '宿舍';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Dorm::with(['School']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('School.name', '学校名称')->hide();
            $grid->column('name');
            $grid->column('remark');
            $grid->column('sort')->sortable()->editable();
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('School.name', '学校名称')->select(School::IdValue());
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Dorm(), function (Form $form) {
            $form->display('id');
            $form->select('school_id')->options(School::IdValue())->required();
            $form->text('name')->required();
            $form->text('remark');

            $form->hidden('user_id')->value(1, true);
            $form->number('sort')->rules('integer|min:1')->default(1)->min(1);
        });
    }
}
