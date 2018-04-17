<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckTable extends Model
{
    protected $fillable = ['project_id', 'verifier', 'verifier_leader'];

    // 返回审核人姓名
    public function getVerifierNameAttribute()
    {
    	return User::find($this->verifier)->name;
    }

    // 返回审核领导姓名
    public function getVerifierLeaderNameAttribute()
    {
    	return User::find($this->verifier_leader)->name;
    }
}
