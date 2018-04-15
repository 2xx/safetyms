<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disclosure extends Model
{
    protected $fillable = [
	    		'project_id',
	    		'manager_name_disclosure',
	    		'workshop_leader_disclosure',
	    		'device_leader_disclosure'
    	];
}
