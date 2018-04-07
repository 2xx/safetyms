<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class RegController extends Controller
{
	// 显示注册表单
    public function create()
    {
    	return view('reg');
    }

    // 接收表单数据,保存到数据库
    public function store(Request $req)
    {
    
		$data = $req->post();
		$data['password'] = bcrypt($data['password']);

    	$user = User::create($data);
    	$xxoo = DB::Table('admin_role_users')->insert(['role_id'=>3,'user_id'=>$user->id]);
    	
    	dd($xxoo);
    	return view('success');
    	// return redirect('/admin');
    }

    public function xxoo()
    {
    	echo 'xxoo';
    }

}
