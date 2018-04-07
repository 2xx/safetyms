<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\ProInfo;

class ProInfoController extends Controller
{
    use ModelForm;
        // 项目浏览
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('资料信息种类');
            $content->description('浏览');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建资料种类');
            $content->description('创建');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(ProInfo::class, function (Grid $grid) {

        	$grid->disableRowSelector();
            $grid->id('ID')->sortable();
            $grid->column('info_name','资料名称');
   //          $grid->column('publish_time','发布时间')->display(function($value){
   //          	return date('Y-m-d H:i:s', $value);
   //          });
   //          $grid->column('申请情况')->display(function(){
   //          	return '<a href="">查看列表</a>';
   //          });
   //          $grid->column('state','状态')->display(function($value){
   //          	if($value==1){
   //          		return '<span style="color:gold;">未发布</span>';
   //          	} else if ($value==2){
   //          		return '<strong style="color:green;">发布中</strong>';
   //          	} else if ($value==3){
   //          		return '<span>已结束</span>';
   //          	}
   //          });

   //          $grid->filter(function($filter){

			//     // 去掉默认的id过滤器
			//     $filter->disableIdFilter();

			//     // 在这里添加字段过滤器
			//     $filter->like('pname', '项目名称');

			//     $filter->equal('state','状态')->select([
			//     	1=>'未发布','发布中','已结束'
			//     ]);
			   

			// });
            // $grid->created_at();
            // $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(ProInfo::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('info_name','资料名称');
            $form->textarea('remark','资料说明')->default('');
            // $form->radio('state','状态')->options([1=>'未发布','发布中','已结束'])->default(1);
            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');

            //保存前回调
			// $form->saving(function (Form $form) {
			//     $form->model()->state = 1;
			//     $form->model()->content_id = '';
			//     $form->model()->publish_time = time();
			
			// });
        });
    }
}
