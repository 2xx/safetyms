<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Project;
use Carbon\Carbon;
use Encore\Admin\Widgets\Table;

class ProjectController extends Controller
{
    use ModelForm;

    // 项目浏览
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('项目列表');
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

            $content->body($this->form($id)->edit($id));
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

            $content->header('建立项目');
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
        return Admin::grid(Project::class, function (Grid $grid) {

        	$grid->disableRowSelector();
            $grid->id('ID')->sortable();
            $grid->column('pname','项目名称');
            $grid->column('project_leader','负责人');
            $grid->column('stop_time','截止日期')->display(function($value){
            	return Carbon::parse($value)->toDateString();
            });

            
            $grid->column('申请情况')->display(function(){
            	return '<a href="">查看列表</a>';
            });
            $grid->column('status','状态')->display(function($value){
            	if($value==1){
            		return '<span style="color:gold;">未发布</span>';
            	} else if ($value==2){
            		return '<strong style="color:green;">发布中</strong>';
            	} else if ($value==3){
            		return '<span>已结束</span>';
            	}
            });

            $grid->column('','审核')->display(function(){
              return '<div class="btn-group pull-left" style="margin-right: 10px">
                            <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> 功能</a>
                            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/admin/tender/project/index?_export_=all" target="_blank">员工</a></li>
                                <li><a href="/admin/tender/project/index?_export_=page%3A1" target="_blank">部门领导</a></li>
                                
                            </ul>
                        </div>';
          })->style('width:150px');

            $grid->filter(function($filter){

			    // 去掉默认的id过滤器
			    $filter->disableIdFilter();

			    // 在这里添加字段过滤器
			    $filter->like('pname', '项目名称');

			    $filter->equal('state','状态')->select([
			    	1=>'未发布','发布中','已结束'
			    ]);
			   

			});
            // $grid->created_at();
            // $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id=NULL)
    {
        return Admin::form(Project::class, function (Form $form) use($id){

            $form->tools(function (Form\Tools $tools) use($id){

                // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
                $tools->add('<div class="btn-group pull-left" style="margin-right: 10px">
                            <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i>工程数据表格与审核</a>
                            <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/admin/tender/project/index?_export_=all" target="_blank">安全交底记录表</a></li>
                                <li><a href="/admin/tender/project/index?_export_=all" target="_blank">安全传递卡</a></li>
                                <li><a href="/admin/project/'.$id.'/checktable" >外来单位安全管理情况审核表</a></li>
                            </ul>
                        </div>');
            });

        	// 主要为发包方信息
        	$form->tab('项目基本信息',function($form){

	            $form->text('pname','项目名称');
	            $form->select('department','发包部门')->options([0=>'php教学部']);
	            $form->text('project_leader','负责人')->placeholder('项目负责人');
	            $form->text('project_leader_tel','负责人电话')->placeholder('项目负责人电话');
	            $form->textarea('introduction','项目简介');
	            $form->datetime('stop_time','截止时间')->placeholder('招标截止时间')->default(Carbon::now());
	            $form->radio('status','项目状态')->options([1=>'未发布','发布中','已结束'])->default(1);
        	
        	})->tab('补充信息', function($form){
        	
        		$form->text('job_location','项目作业区域单位')->placeholder('项目(作业)区域单位');
	            $form->text('job_location_leader','区域负责人')->placeholder('区域单位负责人');
	            $form->text('location_leader_tel','负责人电话')->placeholder('区域单位负责人电话');
	            $form->text('field_leader','现场负责人')->placeholder('区域单位现场管理负责人');
	            $form->text('field_leader_tel','现场负责人电话')->placeholder('现场负责人电话');
        	
        	});

 // $form->ignore(['job_location','job_location_leader','location_leader_tel','field_leader','field_leader_tel']);
            // 审核人及意见  部门领导及意见 中标ID 暂时不写
            

            //保存前回调
			$form->saving(function (Form $form) {

			    $form->model()->publish_time = Carbon::now();
			    $form->model()->publisher = Admin::user()->id;


			   
			});
        });
    }

    // 外来单位安全管理情况审核表
    public function checkTable($id)
    {
        // return view('checktable');
        return Admin::content(function (Content $content) {

            $content->header('外来单位安全管理情况审核表');
            $content->description('Check Table');

            $content->body('<b style="color:red;">景水</b>');
        });
    }
}
