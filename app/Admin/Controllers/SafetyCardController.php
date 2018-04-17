<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\SafetyCard;
use Encore\Admin\Facades\Admin;

class SafetyCardController extends Controller
{
    use ModelForm;

    // 主管领导 签字
    public function mangerNameSign($id)
    {
    	$safetycard = SafetyCard::find($id);

        // 如果有权限
        if ($safetycard->manager_name == Admin::user()->id) {

        	$safetycard -> manager_sign = 1; 

        	$safetycard -> save();

        }

    	return redirect('/admin/project/'.$safetycard->project_id.'/safetycard');
    }



    // 车间主任 签字
    public function workshopLeaderSign($id)
    {
    	$safetycard = SafetyCard::find($id);

        // 如果有权限
        if ($safetycard->workshop_leader == Admin::user()->id) {

        	$safetycard -> workshop_sign = 1; 

        	$safetycard -> save();

        }

    	return redirect('/admin/project/'.$safetycard->project_id.'/safetycard');
    }


    // 安全科 签字
    public function safetySectionSign($id)
    {
    	$safetycard = SafetyCard::find($id);

        // 如果有权限
        if ($safetycard->safety_section == Admin::user()->id) {

        	$safetycard -> section_sign = 1; 

        	$safetycard -> save();

        }

    	return redirect('/admin/project/'.$safetycard->project_id.'/safetycard');
    }

    // 安全部 签字
    public function safetyDepartmentSign($id)
    {
    	$safetycard = SafetyCard::find($id);

        // 如果有权限
        if ($safetycard->safety_department == Admin::user()->id) {

        	$safetycard -> department_sign = 1; 

        	$safetycard -> save();

        }

    	return redirect('/admin/project/'.$safetycard->project_id.'/safetycard');
    }


}
