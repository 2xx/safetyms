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
use App\Tender;
use App\TenderFile;
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
            	return '<a href="/admin/tenderlist/'.$this->getKey().'">查看列表</a>';
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

          //   $grid->column('','审核')->display(function(){
          //     return '<div class="btn-group pull-left" style="margin-right: 10px">
          //                   <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i> 功能</a>
          //                   <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          //                       <span class="caret"></span>
          //                       <span class="sr-only">Toggle Dropdown</span>
          //                   </button>
          //                   <ul class="dropdown-menu" role="menu">
          //                       <li><a href="/admin/tender/project/index?_export_=all" target="_blank">员工</a></li>
          //                       <li><a href="/admin/tender/project/index?_export_=page%3A1" target="_blank">部门领导</a></li>
                                
          //                   </ul>
          //               </div>';
          // })->style('width:150px');

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

            // 如果是编辑项目,显示功能按钮    
            if ($id) {
                $form->tools(function (Form\Tools $tools) use($id){

                    // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
                    $tools->add('<div class="btn-group pull-left" style="margin-right: 10px">
                                <a class="btn btn-sm btn-twitter"><i class="fa fa-download"></i>工程数据表格与审核</a>
                                <button type="button" class="btn btn-sm btn-twitter dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/admin/project/'.$id.'/disclosure">安全交底记录表</a></li>
                                    <li><a href="/admin/project/'.$id.'/safetycard">安全传递卡</a></li>
                                    <li><a href="/admin/project/'.$id.'/checktable" >外来单位安全管理情况审核表</a></li>
                                </ul>
                            </div>');
                });
            }

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
            

            // 保存前回调
			$form->saving(function (Form $form) {

			    $form->model()->publish_time = Carbon::now();
			    $form->model()->publisher = Admin::user()->id;

			});

            // 保存后回调
            $form->saved(function (Form $form) {

                $id = $form->model()->id;

                $dirname = public_path('Projects').'/'.'P'.date('Ymd').str_pad($id, 10, '0', STR_PAD_LEFT);

                if (!file_exists($dirname)) {
                    mkdir($dirname);
                }
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


            $form = <<<XXOO
            <style>
                #checktable tr{height:42px; text-align:center;font-size:21px;}
                
            </style>
            <form action='' method='POST'>
                <table id="checktable" border=1 align="center" max-width=1900px>
                    <tr>
                        <td width=42px rowspan=5>外委队伍概况</td>
                        <td width=210px>企业名称(外委)</td>
                        <td colspan=3></td>
                        <td width=240px>企业性质</td>
                        <td>有限责任公司</td>
                    </tr>
                    <tr>
                        <td>企业地址</td>
                        <td colspan=3></td>
                        <td>法人(实际控制人)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>项目(作业)负责人</td>
                        <td width=200px>李强</td>
                        <td width=170px>职务</td>
                        <td width=200px>项目负责人</td>
                        <td width=250px>联系电话</td>
                        <td>13315518289</td>
                    </tr>
                    <tr>
                        <td>安全管理负责人</td>
                        <td></td>
                        <td>职务</td>
                        <td></td>
                        <td>联系电话</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>施工(作业)人数</td>
                        <td></td>
                        <td>专职安全生<br>产管理人员</td>
                        <td></td>
                        <td>特种作业人数</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="height:170px;" rowspan=3>发包方管理</td>
                        <td>发包部门</td>
                        <td>环保能源部</td>
                        <td>负责人</td>
                        <td></td>
                        <td>联系电话</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>项目(作业)区域单位</td>
                        <td></td>
                        <td>负责人</td>
                        <td></td>
                        <td>联系电话</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>区域单位现场<br>管理负责人</td>
                        <td></td>
                        <td>联系电话</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="height:170px;">
                        <td style="width:27px;">工程简介</td>
                        <td colspan=6></td>
                    </tr>
                    <tr style="height:170px;">
                        <td>审核意见</td>
                        <td colspan=3 valign=top style="text-align:left;" >审核人意见</td>
                        <td colspan=3 valign=top style="text-align:left;" >审核部门领导意见</td>
                    </tr>
                </table>
            </form>
XXOO;

            $content->body($form);
        });
    }


    // 安全传递卡
    public function safetycard($id)
    {
        return Admin::content(function (Content $content) {

            $content->header('安全传递卡');
            $content->description('Safety Card');


            $form = <<<XXOO
            <style>
                #checktable tr{height:42px; text-align:center;font-size:21px;}
                
            </style>
            <form action='' method='POST'>
                <table id="checktable" border=1 align="center" max-width=1900px>
                    <tr>
                       <td style="width:100px;">外委<br>单位</td>
                       <td style="width:180px;"></td>
                       <td style="width:100px;">主管<br>领导签字</td>
                       <td colspan="2"></td>
                       <td style="width:100px;">负责人</td>
                       <td style="width:100px;"></td>
                       <td style="width:170px;">工程项目</td>
                       <td colspan="2" style="width:150px;"></td>
                    </tr>
                    <tr>
                        <td>外来<br>单位</td>
                        <td></td>
                        <td>法人代表</td>
                        <td style="width:100px;"></td>
                        <td>责任人</td>
                        <td></td>
                        <td>时间</td>
                        <td style="width:100px;"></td>
                        <td style="width:100px;">地点</td>
                        <td style="width:170px;"></td>
                    </tr>
                    <tr style="height:400px;">
                       <td colspan="10"></td>
                    </tr>
                    <tr>
                        <td>区域<br>单位</td>
                        <td></td>
                        <td>主管领导<br>签字</td>
                        <td></td>
                        <td>车间<br>主任<br>签字</td>
                        <td></td>
                        <td>安全科<br>签字</td>
                        <td></td>
                        <td>安全部<br>签字</td>
                        <td></td>
                    </tr>
                   
                </table>
            </form>
XXOO;

            $content->body($form);
        });
    }



    // 安全交底记录表
    public function disclosure($id)
    {
        return Admin::content(function (Content $content) {

            $content->header('安全交底记录表');
            $content->description('Safety Disclosure');


            $form = <<<XXOO
            <style>
                #checktable tr{height:42px; text-align:center;font-size:21px;}
                
            </style>
            <form action='' method='POST'>
                <table id="checktable" border=1 align="center" max-width=1900px>
                    <tr>
                       <td style="width:70px;">外委<br>单位</td>
                       <td style="width:200px;"></td>
                       <td>主管<br>领导</td>
                       <td colspan="2"></td>
                       <td>负责人</td>
                       <td style="width:100px;"></td>
                       <td>工程项目</td>
                       <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>施工<br>单位</td>
                        <td></td>
                        <td>法人代表</td>
                        <td style="width:100px;"></td>
                        <td>负责人</td>
                        <td style="width:100px;"></td>
                        <td>时间</td>
                        <td></td>
                        <td>施工地点</td>
                        <td style="width:150px;"></td>
                    </tr>
                    <tr style="height:400px;">
                       <td>
                            <div>安</div>
                            <div>全</div>
                            <div>交</div>
                            <div>底</div>
                            <div>内</div>
                            <div>容</div>
                       </td>
                       <td colspan="9"></td>
                    </tr>
                    <tr>
                        <td colspan="10" style="height:300px;"></td>
                    </tr>
                   <tr>
                        <td>区域<br>单位</td>
                        <td colspan="2"></td>
                        <td>主管<br>领导</td>
                        <td colspan="2"></td>
                        <td>车间<br>主任</td>
                        <td></td>
                        <td>设备科长</td>
                        <td></td>
                   </tr>
                </table>
            </form>
XXOO;
      
            $content->body($form);
        });
    }


    // 查看某个项目的申请列表
    public function tenders($id)
    {
        return Admin::content(function (Content $content) use($id){

            $content->header('项目-申请列表');
            $content->description('Tender List');

            $content->body($this->tendergrid($id));
        });
    }

    public function tendergrid($id)
    {
        return Admin::grid(Tender::class, function(Grid $grid)use($id){
            $grid->model()->where('project_id','=',$id);
            $grid->column('xxoo','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            $grid->column('company_name','外委单位名称');
            $grid->column('created_at','申请日期')->display(function($value){
                return Carbon::parse($value)->toDateString();
            });

            $grid->column('','设置')->display(function(){
                return '<a href="">选为中标</a>';
            })->style('width:170px');


            $grid->disableRowSelector();   // 禁止选择

            // $grid->disableActions();    // 禁止操作列

            $grid->actions(function($action){
                $action->disableDelete();  // 禁止删除
                $action->disableEdit();    // 禁止编辑
                
                // 申请ID
                $tender_id = $this->getKey();
                // 资料ID
                $tenderfile_id = TenderFile::where('tender_id','=',$tender_id)->first()->id;
              
                $action->append("<a href='/admin/tenderfile/".$tenderfile_id."/list'>查看上传档案资料</a>&nbsp;&nbsp;&nbsp;&nbsp;");

            });

        });
    }

    //  查看指定申请的所有上传资料
    public function showfiles($id)
    {
        return Admin::content(function (Content $content)use($id){
            $content->header('查看上传资料');
            $content->header('Show Uploaded Files');
            $content->body($this->showfilesForm()->edit($id));
        });
    }


    public function showfilesForm()
    {
        return Admin::form(TenderFile::class, function(Form $form){

                $form->tab('需上传资料1', function ($form){
         
                   $form->display('license','营业执照')->with(function($value){
                        return "<img src='/Projects/$value' />";
                   });
                   $form->image('certificate','施工等级资质证书');
                   $form->image('authorization','授权书');
                   $form->image('legal_cert','法人代表资质证书');
                   $form->image('special_cert','特种作业操作证');
                   $form->image('device_report','特种设备检验报告');
                   $form->textarea('job_resume','施工简历和近3年安全施工记录');

                });

                $form->tab('需上传资料2', function ($form){

                   $form->file('safety_protocol','安全管理协议');
                   $form->file('safety_cart','安全传递卡');
                   $form->file('safety_record','安全交底记录');

                   $form->file('safety_responsibility','安全生产责任制');
                   $form->file('safety_regulations','安全管理规章制度');
                   $form->file('safety_sop','安全操作规程');
                   $form->file('emergency_rescue_plan','应急救援预案');

                   $form->image('safety_net_diagram','安全组织机构及管理网络图');
                   $form->image('safety_worker_cert','安全管理人员资质证书');

                });

                $form->tab('需上传资料3', function ($form){

                   $form->image('worker_medical','从业人员年龄工种职业健康体检表');
                   $form->image('labor_contract','员工的劳动合同及工伤保险签订和缴纳证明');
                   $form->image('safety_training','相关人员安全教育培训记录');
                   $form->image('electric_ticket','临时用电审批证明');
                   $form->file('construction_scheme','施工方案和安全技术措施');
                   $form->textarea('safety_inspection','施工现场安全检查记录');
                   $form->file('inspection_record','验收记录');
                   $form->file('other_files','其他存档资料');

                });
                $form->disableSubmit(); // 去除提交按钮
                $form->disableReset();  // 去除重置按钮
        });
    }



}
