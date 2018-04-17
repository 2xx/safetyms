<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Disclosure;
use Encore\Admin\Facades\Admin;

class DisclosureController extends Controller
{
    use ModelForm;

    // 主管领导 签字
    public function managerNameSign($id)
    {
    	$disclosure = Disclosure::find($id);

        // 如果有权限
        if ($disclosure->manager_name == Admin::user()->id) {

        	$disclosure -> manager_sign = 1; 

        	$disclosure -> save();

        }

    	return redirect('/admin/project/'.$disclosure->project_id.'/disclosure');
    }


    // 车间主任 签字
    public function workershopLeaderSign($id)
    {
    	$disclosure = Disclosure::find($id);

        // 如果有权限
        if ($disclosure->workshop_leader == Admin::user()->id) {

        	$disclosure -> workshop_sign = 1; 

        	$disclosure -> save();

        }

    	return redirect('/admin/project/'.$disclosure->project_id.'/disclosure');
    }


    // 设备科长 签字
    public function deviceLeaderSign($id)
    {
    	$disclosure = Disclosure::find($id);

        // 如果有权限
        if ($disclosure->device_leader == Admin::user()->id) {

        	$disclosure -> device_sign = 1; 

        	$disclosure -> save();

        }

    	return redirect('/admin/project/'.$disclosure->project_id.'/disclosure');
    }

}
