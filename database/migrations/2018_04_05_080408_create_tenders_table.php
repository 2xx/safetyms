<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->comment('项目ID');
            $table->integer('user_id')->comment('申请人ID');
            $table->string('company_name')->comment('企业名称');
            $table->string('company_type')->comment('企业性质');
            $table->string('company_addr')->comment('企业地址');
            $table->string('legal_person')->comment('企业法人');
            
            $table->string('project_leader')->comment('项目负责人');
            $table->string('project_leader_duty')->comment('项目负责人职务');
            $table->string('project_leader_tel')->comment('项目负责人电话');

            $table->string('safety_leader')->comment('安全负责人');
            $table->string('safety_leader_duty')->comment('安全负责人职务');
            $table->string('safety_leader_tel')->comment('安全负责人电话');

            $table->integer('worker_count')->comment('施工人数');
            $table->string('safe_worker')->comment('专职安全员');
            $table->integer('special_workers')->comment('特种作业人数');

            $table->integer('status')->comment('申请状态');

            $table->timestamps(); // 申请时间  修改时间
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenders');
    }
}
