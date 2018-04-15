<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_num')->comment('项目规范编号')->default('');
            $table->string('pname')->comment('项目名称');
            $table->integer('department')->comment('发包部门')->unsigned();
            $table->integer('publisher')->comment('项目发布人')->unsigned();
            $table->string('project_leader')->comment('项目负责人')->default('');
            $table->string('project_leader_tel')->comment('项目负责人电话')->default('');
            $table->string('job_location')->comment('项目作业区域单位')->default('');
            $table->string('job_location_leader')->comment('作业区域单位负责人')->default('');
            $table->string('location_leader_tel')->comment('区域负责人电话')->default('');
            $table->string('field_leader')->comment('现场负责人')->default('');
            $table->string('field_leader_tel')->comment('现场负责人电话')->default('');
            $table->string('introduction')->comment('项目简介')->default('');
            $table->integer('verifier')->comment('审核人')->default(0);
            $table->string('verifier_opinion')->comment('审核人意见')->default('');
            $table->integer('verifier_leader')->comment('审核部分领导')->default(0);
            $table->string('leader_opinion')->comment('审核部分领导意见')->default('');
            $table->datetime('publish_time')->comment('发布时间');
            $table->datetime('stop_time')->comment('截止时间');
            $table->integer('tender_id')->comment('中标ID')->default(0);
            $table->integer('status')->comment('1未发布 2已发布 3结束')->default(1);

 

            $table->integer('manager_name_card')->comment('主管领导')->default(0);
            $table->integer('workshop_leader_card')->comment('车间主任')->default(0);
            $table->integer('safety_section_card')->comment('安全科')->default(0);
            $table->integer('safety_department_card')->comment('安全部')->default(0);


            $table->integer('manager_name_disclosure')->comment('主管领导')->default(0);
            $table->integer('workshop_leader_disclosure')->comment('车间主任')->default(0);
            $table->integer('device_leader_disclosure')->comment('设备科长')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
