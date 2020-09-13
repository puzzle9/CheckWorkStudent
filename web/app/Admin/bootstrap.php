<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
// View::prependNamespace('admin', resource_path('views/laravel-admin'));
Grid::resolving(function (Grid $grid) {
    $grid->model()->orderBy('id', 'desc');
    $grid->disableRowSelector();

    $grid->filter(function (Grid\Filter $filter) {
        $filter->panel();
    });

    $grid->actions(function (Grid\Displayers\Actions $actions) {
        // $actions->disableDelete();
        // $actions->disableEdit();
        // $actions->disableQuickEdit();
        $actions->disableView();
    });
});

Form::resolving(function (Form $form) {
     $form->disableEditingCheck();
     $form->disableViewCheck();

     $form->tools(function (Form\Tools $tools) {
          // $tools->disableDelete();
          $tools->disableView();
          // $tools->disableList();
     });
});
