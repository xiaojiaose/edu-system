<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\BatchSendMsg;
use App\Student;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StudentController extends AdminController
{
    protected $title = 'Student';

    /**
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

        $grid->batchActions(function ($batch) {
            $batch->add(new BatchSendMsg());
        });

        $grid->column('id', 'Id');
        $grid->column('name', 'Name');
        $grid->column('email', 'Email');
        $grid->column('password', 'Password');
        $grid->column('remember_token', 'Remember token');
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');
        $grid->column('school_id', 'school id');
        $grid->column('line_id', 'Line id');

        return $grid;
    }

    /**
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Student::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('name', 'Name');
        $show->field('email', 'Email');
        $show->field('password', 'Password');
        $show->field('remember_token', 'Remember token');
        $show->field('school_id', 'school id');
        $show->field('line_id', 'Line id');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student());
        $form->text('name', 'Name');
        $form->email('email', 'Email');
        $form->password('password', 'Password');
        $form->text('remember_token', 'Remember token');
        $form->number('school_id', 'Student school id');
        $form->text('line_id', 'Line id');
        $form->saving(function (Form $form) {
            if (!empty($form->password)) {
                $form->password = bcrypt($form->password);
            }
        });
        return $form;
    }
}
