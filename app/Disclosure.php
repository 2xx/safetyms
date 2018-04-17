<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disclosure extends Model
{
    protected $fillable = [
	    		'project_id',
	    		'manager_name',
	    		'workshop_leader',
	    		'device_leader'
    	];

    // 获取 主管领导 姓名 
   	public function getManagerNameStrAttribute()
   	{
   		return User::find($this->manager_name)->name;
   	}

   	// 获取 车间主任 姓名
   	public function getWorkshopLeaderStrAttribute()
   	{
   		return User::find($this->workshop_leader)->name;
   	}

   	// 获取 设备科长 姓名
   	public function getDeviceLeaderStrAttribute()
   	{
   		return User::find($this->device_leader)->name;
   	}
}
