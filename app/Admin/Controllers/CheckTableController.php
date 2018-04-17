<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\CheckTable;
use Encore\Admin\Facades\Admin;

class CheckTableController extends Controller
{
    use ModelForm;


    // 审核人 签字
    public function verifierSign($id)
    {
    	$checkTable = CheckTable::find($id);

        // 如果有权限
        if ($checkTable->verifier == Admin::user()->id) {

    	       $checkTable -> verifier_sign = 1; 

    	       $checkTable -> save();
        }
      
    	return redirect('/admin/project/'.$checkTable->project_id.'/checktable');
    }

    // 部门领导 签字
    public function verifierLeadrSign($id)
    {
    	$checkTable = CheckTable::find($id);

        // 如果有权限
        if ($checkTable->verifier_leader == Admin::user()->id) {

        	$checkTable -> leader_sign = 1; 

        	$checkTable -> save();

        }

    	return redirect('/admin/project/'.$checkTable->project_id.'/checktable');
    }
}
