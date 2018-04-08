<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Project;     // 项目模型
use App\Tender;      // 申请模型
use App\TenderFile;  // 申请文件模型
use Carbon\Carbon;

class TenderController extends Controller
{
    use ModelForm;

    /*
       1)创建 申请      记录   只要 project_id, user_id 两个字段
       2)创建 申请_档案 记录   只要上一步 申请ID
       3)跳转到 编辑 申请记录

       目的是: 不用 create 这步
    */
    public function makeTender($projectid)
    {
        $tender      = Tender::create(['project_id'=>(int)$projectid, 'user_id'=>Admin::user()->id]);
        $tender_file = TenderFile::create(['tender_id'=>$tender->id]);

        $dirname = public_path('Projects').'/'.'P'.date('Ymd').str_pad($projectid, 10, '0', STR_PAD_LEFT);

        // 如果项目目录不存在就创建
        if (!file_exists($dirname)) {
            mkdir($dirname);
        }

        $dirname .= '/Tender'.date('Ymd').str_pad($tender->id, 10, '0', STR_PAD_LEFT);
        // 如果申请目录不存在就创建
        if (!file_exists($dirname)){
            mkdir($dirname);
        }
        

        return redirect('/admin/tender/'.$tender->id.'/edit');
    }
    
    // 项目浏览
    public function projectindex()
    {
        return Admin::content(function (Content $content) {

            $content->header('项目列表');
            $content->description('浏览');

            $content->body($this->projectgrid());
        });
    }

    // 我的申请
    public function index()
    {
        return Admin::content(function (Content $content) {

              $content->header('申请列表');
              $content->description('浏览');

              $content->body($this->grid());
          });
    }

    // 申请列表
    protected function grid()
    {
        return Admin::grid(Tender::class, function (Grid $grid) {

          // 只显示 发布中 和 已结束 的项目
          $grid->model()->where('user_id','=',Admin::user()->id);

          // $grid->disableActions(); // 去掉 操作  列

          $grid->disableCreateButton(); // 去掉 创建 功能

          $grid->actions(function ($actions) {

              $actions->disableDelete();  // 禁用 删除
              $actions->disableEdit();    // 禁用 修改

              
              
              $actions->append("<a href='/admin/tender/upload/".$this->getKey()."'>上传档案资料</a>&nbsp;&nbsp;&nbsp;&nbsp;");
              $actions->append("<a href='/admin/tender/".$this->getKey()."/edit'>修改</a>&nbsp;&nbsp;&nbsp;&nbsp;");
              $actions->append("<a href='/admin/tender/commit/".$this->getKey()."'>提交</a>");

          });


            $grid->disableRowSelector(); // 禁用 多行选择
            $grid->id('ID');
            $grid->column('project_id','项目名称')->display(function($value){
                return Project::find($value)->pname;
            });
            $grid->column('create_at','申请时间')->display(function($value){
                return Carbon::parse($value)->toDateString();
            });


            $grid->column('status','状态')->display(function($value){
              if($value==1){
                return '<span style="color:gold;">未提交</span>';
              } else if ($value==2){
                return '<strong style="color:green;">已提交</strong>';
              } else if ($value==3){
                return '<span>审核通过</span>';
              } else if ($value==4){
                return '<strong style="color:red;">中标</strong>';
              }
            });


            $grid->filter(function($filter){

          // 去掉默认的id过滤器
          $filter->disableIdFilter();

          // 在这里添加字段过滤器
          $filter->like('pname', '项目名称');

          $filter->equal('state','状态')->select([
            1=>'未发布','发布中','已结束'
          ]);
         

      });
            
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

            $content->header('申请信息');
            $content->description('Tender Information');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
       创建投标记录
     * $id 可选参数  项目的ID
     * @return Content
     */
    public function create()
    {
        $id = $_GET['id'];
        return Admin::content(function (Content $content) use($id){

            $content->header('申请项目');
            $content->description('创建');

            $content->body($this->form($id));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function projectgrid()
    {
        return Admin::grid(Project::class, function (Grid $grid) {

        	// 只显示 发布中 和 已结束 的项目
        	$grid->model()->where('status','<>',1);

        	// $grid->disableActions(); // 去掉 操作  列

        	$grid->disableCreateButton(); // 去掉 创建 功能

        	$grid->actions(function ($actions) {

			    $actions->disableDelete();  // 禁用 删除
			    $actions->disableEdit();    // 禁用 修改


          // 如果申请表中已经存在这个项目的申请,那么就不显示 申请该项目的 超链接
          $tender = Tender::where('user_id','=',Admin::user()->id)->where('project_id','=',$actions->getKey())->first();
          if (!$tender) {
			       $actions->append('<a href="/admin/tender/maketender/'.$actions->getKey().'">申请该项目</a>');
          }


			});





        	$grid->disableRowSelector(); // 禁用 多行选择
            $grid->id('ID');
            $grid->column('pname','项目名称');
            $grid->column('stop_time','截止日期')->display(function($value){
            	return Carbon::parse($value)->toDateString();
            });

            // $grid->column('申请情况')->display(function(){
            // 	return '<a href="">未申情</a>';
            // });

            $grid->column('status','状态')->display(function($value){
            	if($value==1){
            		return '<span style="color:gold;">未发布</span>';
            	} else if ($value==2){
            		return '<strong style="color:green;">发布中</strong>';
            	} else if ($value==3){
            		return '<span>已结束</span>';
            	}
            });

            


            $grid->filter(function($filter){
      			    
      			    $filter->disableIdFilter();          // 去掉默认的id过滤器
      			    $filter->like('pname', '项目名称');  // 在这里添加字段过滤器
      			    $filter->equal('state','状态')->select([1=>'未发布','发布中','已结束']);

      			});
            
        });
    }

    /**
     * Make a form builder.
     * $id 项目ID
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Tender::class, function (Form $form) {

            $form->tab('基本设置', function ($form){

            	// $form->text('','项目名称')->value(Project::find($id)->pname)->readonly();
            	// $form->text('','用户名称')->value(Admin::user()->name)->readonly();
              // $form->hidden('project_id');  // 项目ID

            	// $form->divide();

            	$form->text('company_name','企业名称');
            	$form->text('company_type','企业性质');
            	$form->text('company_addr','企业地址');
            	$form->text('legal_person','企业法人');
			
			      });

       

           $form->tab('其它信息', function($form){
           		$form->text('project_leader','项目负责人');
           		$form->text('project_leader_duty','职务');
           		$form->text('project_leader_tel','电话');

           		$form->divide();

           		$form->text('safety_leader','安全负责人');
           		$form->text('safety_leader_duty','职务');
           		$form->text('safety_leader_tel','电话');

           		$form->divide();

           		$form->text('worker_count','施工人数');
           		$form->text('safe_worker','专职安全员');
           		$form->text('special_workers','特种作业人数');

           });
			
   
            /*

       		
				*/
         
            // $project_id = $_GET['id']; 
            //保存前回调
      			$form->saving(function (Form $form) {
              // dd($id);
      				$form->model()->user_id = Admin::user()->id; // 申请人ID
              // $form->model()->project_id = $id;   // 项目ID
      				$form->model()->status = 1;   // 申请状态
      			});
        });
    }
}
