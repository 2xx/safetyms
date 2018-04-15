<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckTable extends Model
{
    protected $fillable = ['project_id', 'verifier', 'verifier_leader'];
}
