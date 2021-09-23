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
        });

        $grid->column('id', 'Id');
        $grid->column('name', 'Name');
        $grid->column('email', 'Email');
        $grid->column('password', 'Password');
        $grid->column('remember_token', 'Remember token');
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');
        $grid->column('is_student', 'Is student')->filter();
        $grid->column('student_school_id', 'Student school id');
        $grid->column('is_teacher', 'Is teacher');
        $grid->column('is_system_admin', 'Is system admin');
        $grid->column('line_id', 'Line id');

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

        $show->field('id', 'Id');
        $show->field('name', 'Name');
        $show->field('email', 'Email');
        $show->field('password', 'Password');
        $show->field('remember_token', 'Remember token');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');
        $show->field('is_student', 'Is student');
        $show->field('student_school_id', 'Student school id');
        $show->field('is_teacher', 'Is teacher');
        $show->field('is_system_admin', 'Is system admin');
        $show->field('line_id', 'Line id');

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

        $form->text('name', 'Name');
        $form->email('email', 'Email');
        $form->password('password', 'Password');
        $form->text('remember_token', 'Remember token');
        $form->datetime('is_student', 'Is student')->default(date('Y-m-d H:i:s'));
        $form->number('student_school_id', 'Student school id');
        $form->datetime('is_teacher', 'Is teacher')->default(date('Y-m-d H:i:s'));
        $form->datetime('is_system_admin', 'Is system admin')->default(date('Y-m-d H:i:s'));
        $form->text('line_id', 'Line id');

        return $form;
    }
}
