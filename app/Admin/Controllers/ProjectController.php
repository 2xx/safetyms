<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Project;     // 项目模型
use App\Department;     // 项目模型
use App\User;     // 项目模型
use Carbon\Carbon;   // 时间处理类
use App\Tender;      // 申请模型
use App\TenderFile;  // 申请文件记录表模型
use App\CheckTable;  // 外来单位安全管理情况审核表
use App\Disclosure;  // 安全交底记录
use App\SafetyCard;  // 安全传递卡
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use DB;

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

            $content->header('编辑');
            $content->description('edit');

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
     * @return Form  虽然没注释,但已经被作废
     */
    protected function createform()
    {
        return Admin::form(Project::class, function (Form $form) {

        	// 主要为发包方信息
        	$form->tab('项目基本信息',function($form){

	            $form->text('pname','项目名称');
	            $form->select('department','发包部门')->options(function(){
                    $departments = Department::all();
                    $arr[0] = '环保能源部';
                    foreach ($departments as $k => $v) {
                        $arr[ $v->id ] = $v->dname;
                    }
                    return $arr;
                });
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
        	
        	})->tab('设置项目审核人', function($form){


                // 获取不是 外委单位的 用户名称数组
                $arr_uid  = DB::Table('admin_role_users')->where('role_id','<>',3)->pluck('user_id');
                $arr_user = User::whereIn('id', $arr_uid)->pluck('name','id')->toArray();
                $arr_user[0] = '未选择';
        
                $form->html('<h3>外来单位安全管理情况审核表</h3>');
                $form->select('verifier','审核人')->options($arr_user);
                $form->select('verifier_leader','审核部门领导')->options($arr_user);
                $form->divide();

                $form->html('<h3>安全传递卡</h3>');
                $form->select('manager_name_card','主管领导签字')->options($arr_user);
                $form->select('workshop_leader_card','车间主任签字')->options($arr_user);
                $form->select('safety_section_card','安全科签字')->options($arr_user);
                $form->select('safety_department_card','安全部签字')->options($arr_user);
                $form->divide();

                $form->html('<h3>安全交底记录表</h3>');
                $form->select('manager_name_disclosure','主管领导')->options($arr_user);
                $form->select('workshop_leader_disclosure','车间主任')->options($arr_user);
                $form->select('device_leader_disclosure','设备科长')->options($arr_user);
               

            });

            $form->ignore([
                    'verifier',
                    'verifier_leader',

                    'manager_name_card',
                    'workshop_leader_card',
                    'safety_section_card',
                    'safety_department_card',

                    'manager_name_disclosure',
                    'workshop_leader_disclosure',
                    'device_leader_disclosure'
                ]);
            // 审核人及意见  部门领导及意见 中标ID 暂时不写
            

            // 保存前回调
			$form->saving(function (Form $form) {

			    $form->model()->publish_time = Carbon::now();
			    $form->model()->publisher = Admin::user()->id;

			});


            // dump(request()->route()->parameters());
            // 保存后回调
            $form->saved(function (Form $form){

                
                $id = $form->model()->id;

                // 创建项目目录
                $dirname = public_path('Projects').'/'.'P'.date('Ymd').str_pad($id, 10, '0', STR_PAD_LEFT);
                if (!file_exists($dirname)) {
                    mkdir($dirname);
                }

                // 获取设置审核人数据
                $project_id = $form->model()->id;

                $arr_checktable['project_id'] = $project_id;
                $arr_checktable['verifier'] = $form->model()->verifier;
                $arr_checktable['verifier_leader'] = $form->model()->verifier_leader;

                $arr_safetycard['project_id'] = $project_id;
                $arr_safetycard['manager_name_card']    = $form->model()->manager_name_card;
                $arr_safetycard['workshop_leader_card'] = $form->model()->workshop_leader_card;
                $arr_safetycard['safety_section_card']  = $form->model()->safety_section_card;
                $arr_safetycard['safety_department_card'] = $form->model()->safety_department_card;

                $arr_disclosure['project_id'] = $project_id;
                $arr_disclosure['manager_name_disclosure'] = $form->model()->manager_name_disclosure;
                $arr_disclosure['workshop_leader_disclosure'] = $form->model()->workshop_leader_disclosure;
                $arr_disclosure['device_leader_disclosure'] = $form->model()->device_leader_disclosure;


                // 如果是创建项目,那么就同时在另外三张表中添加记录
                // $data = request()->route()->parameters();
                // if (empty($data)) {
                    // 创建项目-外来单位安全管理情况审核表
                    CheckTable::create( $arr_checktable );

                    // 创建项目-安全交底记录表
                    Disclosure::create( $arr_safetycard );

                    // 创建项目-安全传递卡
                    SafetyCard::create( $arr_disclosure );
                // }

            });

        });
    }

    protected function form($id=null)
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
                $form->select('department','发包部门')->options(function(){
                    $departments = Department::all();
                    $arr[0] = '环保能源部';
                    foreach ($departments as $k => $v) {
                        $arr[ $v->id ] = $v->dname;
                    }
                    return $arr;
                });
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
            
            })->tab('设置项目审核人', function($form){


                // 获取不是 外委单位的 用户名称数组
                $arr_uid  = DB::Table('admin_role_users')->where('role_id','<>',3)->pluck('user_id');
                $arr_user = User::whereIn('id', $arr_uid)->pluck('name','id')->toArray();
                $arr_user[0] = '未选择';
        
                $form->html('<h3>外来单位安全管理情况审核表</h3>');
                $form->select('verifier','审核人')->options($arr_user);
                $form->select('verifier_leader','审核部门领导')->options($arr_user);
                $form->divide();

                $form->html('<h3>安全传递卡</h3>');
                $form->select('manager_name_card','主管领导签字')->options($arr_user);
                $form->select('workshop_leader_card','车间主任签字')->options($arr_user);
                $form->select('safety_section_card','安全科签字')->options($arr_user);
                $form->select('safety_department_card','安全部签字')->options($arr_user);
                $form->divide();

                $form->html('<h3>安全交底记录表</h3>');
                $form->select('manager_name_disclosure','主管领导')->options($arr_user);
                $form->select('workshop_leader_disclosure','车间主任')->options($arr_user);
                $form->select('device_leader_disclosure','设备科长')->options($arr_user);
               

            });

            // $form->ignore([
            //         'verifier',
            //         'verifier_leader',

            //         'manager_name_card',
            //         'workshop_leader_card',
            //         'safety_section_card',
            //         'safety_department_card',

            //         'manager_name_disclosure',
            //         'workshop_leader_disclosure',
            //         'device_leader_disclosure'
            //     ]);
            // 审核人及意见  部门领导及意见 中标ID 暂时不写
            

            // 保存前回调
            $form->saving(function (Form $form) {

                $form->model()->publish_time = Carbon::now();
                $form->model()->publisher = Admin::user()->id;

            });


            // dump(request()->route()->parameters());
            // 保存后回调
            $form->saved(function (Form $form){

                
                $project_id = $form->model()->id;

                // 创建项目目录
                $dirname = public_path('Projects').'/'.'P'.date('Ymd').str_pad($project_id, 10, '0', STR_PAD_LEFT);
                if (!file_exists($dirname)) {
                    mkdir($dirname);
                }

                // 获取设置审核人数据

                $arr_checktable['verifier'] = $form->model()->verifier;
                $arr_checktable['verifier_leader'] = $form->model()->verifier_leader;

                $arr_safetycard['manager_name_card']    = $form->model()->manager_name_card;
                $arr_safetycard['workshop_leader_card'] = $form->model()->workshop_leader_card;
                $arr_safetycard['safety_section_card']  = $form->model()->safety_section_card;
                $arr_safetycard['safety_department_card'] = $form->model()->safety_department_card;

                $arr_disclosure['manager_name_disclosure'] = $form->model()->manager_name_disclosure;
                $arr_disclosure['workshop_leader_disclosure'] = $form->model()->workshop_leader_disclosure;
                $arr_disclosure['device_leader_disclosure'] = $form->model()->device_leader_disclosure;


                // 如果是创建项目,那么就同时在另外三张表中添加记录
                // $data = request()->route()->parameters();
                // if (empty($data)) {
                    // 创建项目-外来单位安全管理情况审核表
                    CheckTable::updateOrCreate(['project_id'=>$project_id], $arr_checktable);

                    // 创建项目-安全交底记录表
                    Disclosure::updateOrCreate(['project_id'=>$project_id], $arr_safetycard);

                    // 创建项目-安全传递卡
                    SafetyCard::updateOrCreate(['project_id'=>$project_id], $arr_disclosure);
                // }

            });

        });
    }

    // 外来单位安全管理情况审核表   参数:项目id
    public function checkTable($id)
    {
        // return view('checktable');
        return Admin::content(function (Content $content) use($id) {

            $content->header('外来单位安全管理情况审核表');
            $content->description('Check Table');

            $checkTable = CheckTable::where('project_id','=',$id)->first();
            // var_dump($checkTable);die;

            $content->body(view('checktable',['checkTable'=>$checkTable]));
        });
    }

    public function updatechecktable(Request $req, $id)
    {
        $data = $req->except(['_token']);
        CheckTable::where('id',$id)->update($data);
        return redirect('/admin/project');
    }


    // 安全传递卡
    public function safetycard($id)
    {
        return Admin::content(function (Content $content) use($id) {

            $content->header('安全传递卡');
            $content->description('Safety Card');

            $safetyCard = SafetyCard::where('project_id','=',$id)->first();
            $content->body(view('project/safetycard',['safetyCard'=>$safetyCard]));
        });
    }

    public function updatesafetycard(Request $req, $id)
    {
        $data = $req->except(['_token']);
        SafetyCard::where('id',$id)->update($data);
        return redirect('/admin/project');
    }

    // 安全交底记录表
    public function disclosure($id)
    {
        return Admin::content(function (Content $content) use($id) {

            $content->header('安全交底记录表');
            $content->description('Safety Disclosure');

            $disclosure = Disclosure::where('project_id','=',$id)->first();
            $content->body(view('project/disclosure',['disclosure'=>$disclosure]));
        });
    }

    public function updatedisclosure(Request $req, $id)
    {
        $data = $req->except(['_token']);
        Disclosure::where('id',$id)->update($data);
        return redirect('/admin/project');
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

                return '<a href="/admin/tender/accepted/'.$this->id.'">选为中标</a>';
            })->style('width:170px');

            $grid->disableCreateButton();  // 禁止添加

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
         
                   // $form->display('license','营业执照')->with(function($value){
                   //      return "<img src='/Projects/$value' />";
                   // });
                   $form->image('license','营业执照');
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
