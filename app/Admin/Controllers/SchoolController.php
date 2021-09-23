<?php

namespace App\Admin\Controllers;

use App\School;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class SchoolController extends AdminController
{

    protected $title = 'School';

    protected function grid()
    {

        $grid = new Grid(new School());
        $grid->disableCreateButton();

        $grid->column('id', 'Id');
        $grid->column('name', 'Name');

        $grid->column('creator.name', 'Creator');
        $grid->column('approve_name', 'Approve Name');
        $grid->column('approve_time', 'Approve time');
        $grid->column('created_at', 'Created at');
        $grid->column('updated_at', 'Updated at');

        return $grid;
    }


    protected function detail($id)
    {
        $show = new Show(School::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('name', 'Name');
        $show->field('approve_time', 'Approve time');
        $show->field('approve_name', 'Approve Name');
        $show->field('creator.name', 'Creator');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');

        return $show;
    }


    protected function form()
    {
        $user = Auth::guard('admin')->user();
        $form = new Form(new School());
        $form->text('name', 'Name');
        $form->text('approve_name', 'Approve Name')->default($user->name)->readonly();
        $form->datetime('approve_time', 'Approve time')->default(date('Y-m-d H:i:s'));
        $form->saving(function (Form $form) use ($user) {
            if (empty($form->model()->getAttribute("creator_id"))) {
                $form->model()->setAttribute("creator_id", $user->id);
            }
        });

        return $form;
    }
}
