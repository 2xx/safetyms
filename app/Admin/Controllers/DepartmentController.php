<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Department;

class DepartmentController extends Controller
{
    use ModelForm;

    
    // 添加部门
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('添加部门');
            $content->description('Create Department');

            $content->body($this->form());
        });
    }

    // 编辑部门
    public function edit($id)
    {
    	return Admin::content(function (Content $content) use($id){
    		$content->header('部门信息编辑');
    		$content->description('Department Edit');
    		$content->body($this->form()->edit($id));
    	});
    }

    public function form()
    {
    	return Admin::form(Department::class, function(Form $form){

    		$form->text('dname','部门名称');


    	});
    }


    // 浏览部门
    public function index()
    {
    	return Admin::content(function(Content $content){
    		$content->header('部门列表');
    		$content->description('Department List');
    		$content->body($this->grid());
    	});
    }

    public function grid()
    {
    	return Admin::grid(Department::class, function(Grid $grid){
    		$grid->disableRowSelector();
    		$grid->column('id','编号');
    		$grid->column('dname','部门名称');
    	});
    }

}
