<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyCard extends Model
{
    protected $fillable = [
    		'project_id',
    		'manager_name_card',
    		'workshop_leader_card',
    		'safety_section_card',
    		'safety_department_card'
    	];
}
