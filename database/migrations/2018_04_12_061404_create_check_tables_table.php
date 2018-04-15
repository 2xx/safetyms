<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->comment('项目ID');
            $table->string('company_name')->comment('企业名称')->default('')->nullable();
            $table->string('company_type')->comment('企业性质')->default('')->nullable();
            $table->string('company_addr')->comment('企业地址')->default('')->nullable();
            $table->string('legal_person')->comment('企业法人')->default('')->nullable();
            
            $table->string('project_leader')->comment('项目负责人')->default('')->nullable();
            $table->string('project_leader_duty')->comment('项目负责人职务')->default('')->nullable();
            $table->string('project_leader_tel')->comment('项目负责人电话')->default('')->nullable();

            $table->string('safety_leader')->comment('安全负责人')->default('')->nullable();
            $table->string('safety_leader_duty')->comment('安全负责人职务')->default('')->nullable();
            $table->string('safety_leader_tel')->comment('安全负责人电话')->default('')->nullable();

            $table->integer('worker_count')->comment('施工人数')->default(0)->nullable();
            $table->string('safe_worker')->comment('专职安全员')->default('')->nullable();
            $table->integer('special_workers')->comment('特种作业人数')->default(0)->nullable();


            $table->string('department')->comment('发包部门')->default('')->nullable();
            $table->integer('publisher')->comment('项目发布人')->unsigned()->default(0)->nullable();
            $table->string('department_project_leader')->comment('项目负责人')->default('')->nullable();
            $table->string('department_project_leader_tel')->comment('项目负责人电话')->default('')->nullable();
            $table->string('job_location')->comment('项目作业区域单位')->default('')->nullable();
            $table->string('job_location_leader')->comment('作业区域单位负责人')->default('')->nullable();
            $table->string('location_leader_tel')->comment('区域负责人电话')->default('')->nullable();
            $table->string('field_leader')->comment('现场负责人')->default('')->nullable();
            $table->string('field_leader_tel')->comment('现场负责人电话')->default('')->nullable();
            $table->text('introduction')->comment('项目简介')->nullable();

            $table->integer('verifier')->comment('审核人')->default(0)->nullable();
            $table->integer('verifier_sign')->comment('审核人是否签字')->default(0)->nullable();
            $table->string('verifier_opinion')->comment('审核人意见')->default('')->nullable();

            $table->integer('verifier_leader')->comment('审核部分领导')->default(0)->nullable();
            $table->integer('leader_sign')->comment('领导是否签字')->default(0)->nullable();
            $table->string('leader_opinion')->comment('审核部分领导意见')->default('')->nullable();


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
        Schema::dropIfExists('check_tables');
    }
}
