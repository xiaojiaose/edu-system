<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->filter(function (Filter $filter) {
            $filter->scope('only-student', 'Only Student')->where('is_student', '>', 0);
            $filter->scope('only-teacher', 'Only Teacher')->where('is_teacher', '>', 0);
            $filter->scope('only-system_admin', 'Only System Admin')->where('is_system_admin', '>', 0);
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('is_student', __('Is student'))->filter();
        $grid->column('student_school_id', __('Student school id'));
        $grid->column('is_teacher', __('Is teacher'));
        $grid->column('is_system_admin', __('Is system admin'));
        $grid->column('line_id', __('Line id'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('is_student', __('Is student'));
        $show->field('student_school_id', __('Student school id'));
        $show->field('is_teacher', __('Is teacher'));
        $show->field('is_system_admin', __('Is system admin'));
        $show->field('line_id', __('Line id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->datetime('is_student', __('Is student'))->default(date('Y-m-d H:i:s'));
        $form->number('student_school_id', __('Student school id'));
        $form->datetime('is_teacher', __('Is teacher'))->default(date('Y-m-d H:i:s'));
        $form->datetime('is_system_admin', __('Is system admin'))->default(date('Y-m-d H:i:s'));
        $form->text('line_id', __('Line id'));

        return $form;
    }
}
