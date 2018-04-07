<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\TenderFile;

class TenderFileController extends Controller
{
    use ModelForm;

    public function uploads($projectid)
    {
        return Admin::content(function (Content $content) use($projectid){

            $content->header('上传档案资料');
            $content->description('Tender Files');

            $content->body($this->uploadForm()->edit($projectid));
        });
    }

    protected function uploadForm()
    {

        return Admin::form(TenderFile::class, function (Form $form) {

         	
            	$form->tab('需上传资料1', function ($form) {

				   $form->image('营业执照')->removable();
				   $form->image('施工等级资质证书');
				   $form->image('授权书');
				   $form->image('法人代表资质证书');
				   $form->image('特种作业操作证');
				   $form->image('特种设备检验报告');
				   $form->textarea('施工简历和近3年安全施工记录');

				});

	           	$form->tab('需上传资料2', function ($form) {

	           	   $form->file('安全管理协议');
				   $form->file('安全传递卡');
				   $form->file('安全交底记录');

				   $form->file('安全生产责任制');
				   $form->file('安全管理规章制度');
				   $form->file('安全操作规程');
				   $form->file('应急救援预案');

				   $form->image('安全组织机构及管理网络图');
				   $form->image('安全管理人员资质证书');

				});

				$form->tab('需上传资料3', function ($form) {

				   $form->image('从业人员年龄工种职业健康体检表');
				   $form->image('员工的劳动合同及工伤保险签订和缴纳证明');
				   $form->image('相关人员安全教育培训记录');
				   $form->image('临时用电审批证明');
				   $form->file('施工方案和安全技术措施');
				   $form->textarea('施工现场安全检查记录');
				   $form->file('验收记录');

				});
     
        });
    
    }


}
