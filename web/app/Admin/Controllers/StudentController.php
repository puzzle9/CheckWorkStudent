<?php

namespace App\Admin\Controllers;

use App\Models\School;
use App\Models\Dorm;
use App\Models\Student;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class StudentController extends AdminController
{
    protected $title = '学生';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Student::with('School', 'Dorm'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('School.name', '学校名称');
            $grid->column('Dorm.name', '宿舍名称');
            $grid->column('bed_name');
            $grid->column('name');
            $grid->column('phone');
            $grid->column('parent_type');
            $grid->column('parent_phone');
            $grid->column('remark');
            $grid->column('sort')->sortable()->editable();
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('School.name', '学校名称')->select(School::IdValue());        
                $filter->equal('Dorm.name', '宿舍名称')->select(Dorm::IdValue());
                $filter->like('bed_name');
                $filter->like('name');
                $filter->like('phone');
                $filter->like('parent_phone');
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
        return Form::make(new Student(), function (Form $form) {
            $bed_name = session('bed_name');
            $dorm_id = session('dorm_id');

            if (!$bed_name || $bed_name == 8) {
                $bed_name = 1;
                $dorm_id = 0;
            } else {
                $bed_name += 1;
            }

            $form->display('id');
            $form->select('school_id')->options(School::IdValue())->value(1, true)->required();
            $form->select('dorm_id')->default($dorm_id)->options(Dorm::IdValue())->required();
            $form->number('bed_name')->default($bed_name)->min(1)->max(8)->required();
            $form->text('name')->required();
            $form->mobile('phone')->options(['mask' => '999 9999 9999']);
            $form->mobile('parent_phone')->options(['mask' => '999 9999 9999']);
            $form->text('parent_type');
            $form->text('remark');

            $form->hidden('user_id')->value(1, true);
            $form->number('sort')->rules('integer|min:1')->default(1)->min(1);

            $form->submitted(function (Form $form) {
                session([
                    'dorm_id' => $form->input('dorm_id'),
                    'bed_name' => $form->input('bed_name'),
                ]);
            });
        });
    }
}
