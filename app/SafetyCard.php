<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyCard extends Model
{
    protected $fillable = [
    		'project_id',
    		'manager_name',
    		'workshop_leader',
    		'safety_section',
    		'safety_department'
    	];


    // 获取安全部签字人姓名
    public function getSafetyDepartmentNameAttribute()
    {
    	return User::find($this->safety_department)->name;
    }

    // 获取安全科签字人姓名
    public function getSafetySectionNameAttribute()
    {
    	return User::find($this->safety_section)->name;
    }

    // 获取车间主任姓名
    public function getWorkshopLeaderNameAttribute()
    {
    	return User::find($this->workshop_leader)->name;
    }

    // 获取主管领导姓名
    public function getManagerNameStrAttribute()
    {
    	return User::find($this->manager_name)->name;
    }

}
