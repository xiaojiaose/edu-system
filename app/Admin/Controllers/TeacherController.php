<?php

namespace App\Admin\Controllers;

use App\Teacher;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TeacherController extends AdminController
{
    /**
     * @var string
     */
    protected $title = 'Teacher';

    /**
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher());

        $grid->column('id', 'Id');
        $grid->column('name', 'Name');
        $grid->column('email', 'Email');
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');
        $grid->column('line_id', 'Line id');

        return $grid;
    }

    /**
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Teacher::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('name', 'Name');
        $show->field('email', 'Email');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');
        $show->field('line_id', 'Line id');

        return $show;
    }


    protected function form()
    {
        $form = new Form(new Teacher());
//        $form->ignore(['password', 'remember_token']);
        $form->text('name', 'Name');
        $form->email('email', 'Email');
        $form->password('password', 'Password');
        $form->text('remember_token', 'Remember token');
        $form->text('line_id', 'Line id');
        $form->saving(function (Form $form) {
            if (!empty($form->password)) {
                $form->password = bcrypt($form->password);
            }
        });
        return $form;
    }
}
