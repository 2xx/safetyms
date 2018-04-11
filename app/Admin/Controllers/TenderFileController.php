<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Tender;
use App\TenderFile;

class TenderFileController extends Controller
{
    use ModelForm;

    public function index()
    {
    	return redirect('/admin/tender');
    }


    public function edit($tenderfile_id)
    {
    	
        return Admin::content(function (Content $content) use($tenderfile_id){

            $content->header('上传档案资料');
            $content->description('Tender Files');

            $content->body($this->form()->edit($tenderfile_id));
        });
    }



    protected function form()
    {

        return Admin::form(TenderFile::class, function (Form $form){

        		// 获取路由参数--资料表ID
				$tenderfile_id= request()->route()->parameters()['tenderfile'];
				// 获取上传文件的保存目录
				$save_dir = TenderFile::find($tenderfile_id)['save_dir'];
				

            	$form->tab('需上传资料1', function ($form)use($save_dir){
         
				   $form->image('license','营业执照')->move($save_dir)->uniqueName()->removable();
				   $form->image('certificate','施工等级资质证书')->move($save_dir)->uniqueName();
				   $form->image('authorization','授权书')->move($save_dir)->uniqueName();
				   $form->image('legal_cert','法人代表资质证书')->move($save_dir)->uniqueName();
				   $form->image('special_cert','特种作业操作证')->move($save_dir)->uniqueName();
				   $form->image('device_report','特种设备检验报告')->move($save_dir)->uniqueName();
				   $form->textarea('job_resume','施工简历和近3年安全施工记录');

				});

	           	$form->tab('需上传资料2', function ($form) use($save_dir) {

	           	   $form->file('safety_protocol','安全管理协议');
				   $form->file('safety_cart','安全传递卡');
				   $form->file('safety_record','安全交底记录');

				   $form->file('safety_responsibility','安全生产责任制')->move($save_dir)->uniqueName();
				   $form->file('safety_regulations','安全管理规章制度')->move($save_dir)->uniqueName();
				   $form->file('safety_sop','安全操作规程')->move($save_dir)->uniqueName();
				   $form->file('emergency_rescue_plan','应急救援预案')->move($save_dir)->uniqueName();

				   $form->image('safety_net_diagram','安全组织机构及管理网络图')->move($save_dir)->uniqueName();
				   $form->image('safety_worker_cert','安全管理人员资质证书')->move($save_dir)->uniqueName();

				});

				$form->tab('需上传资料3', function ($form) use($save_dir) {

				   $form->image('worker_medical','从业人员年龄工种职业健康体检表')->move($save_dir)->uniqueName();
				   $form->image('labor_contract','员工的劳动合同及工伤保险签订和缴纳证明')->move($save_dir)->uniqueName();
				   $form->image('safety_training','相关人员安全教育培训记录')->move($save_dir)->uniqueName();
				   $form->image('electric_ticket','临时用电审批证明')->move($save_dir)->uniqueName();
				   $form->file('construction_scheme','施工方案和安全技术措施')->move($save_dir)->uniqueName();
				   $form->textarea('safety_inspection','施工现场安全检查记录');
				   $form->file('inspection_record','验收记录')->move($save_dir)->uniqueName();
				   $form->file('other_files','其他存档资料')->move($save_dir)->uniqueName();

				});
     
        });
    
    }


}
