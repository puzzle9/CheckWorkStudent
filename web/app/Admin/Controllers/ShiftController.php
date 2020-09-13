<?php

namespace App\Admin\Controllers;

use App\Models\Shift;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ShiftController extends AdminController
{
    protected $title = '班次';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Shift(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('sort');
            $grid->column('updated_at')->sortable();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Shift(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->hidden('user_id')->value(1, true);
            $form->number('sort')->rules('integer|min:1')->default(1)->min(1);
        });
    }
}
