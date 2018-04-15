<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisclosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disclosures', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('project_id')->comment('项目ID');

            $table->string('department_name',255)->default('')->comment('外委单位')->nullable();
            $table->string('department_leader')->default('')->comment('主管领导签字')->nullable();
            $table->string('charge')->default('')->comment('负责人')->nullable();
            $table->string('project_name')->default('')->comment('工程项目')->nullable();
            $table->string('company_name')->default('')->comment('外来单位')->nullable();
            $table->string('legal_person')->default('')->comment('法人代表')->nullable();
            $table->string('company_duty')->default('')->comment('责任人')->nullable();
            $table->datetime('job_time')->nullable()->comment('时间');
            $table->string('project_addr')->default('')->comment('地点')->nullable();

            $table->text('safety_content')->nullable()->comment('安全交底内容');
            $table->text('content')->nullable()->comment('原表格的空白');

            $table->string('field_name')->default('')->comment('区域单位')->nullable();
                   
            $table->integer('manager_name')->default(0)->comment('主管领导签字')->nullable();
            $table->tinyInteger('manager_sign')->default(0)->comment('是否签字 0表示未签 1表示已签')->nullable();   

            $table->integer('workshop_leader')->default(0)->comment('车间主任签字')->nullable();
            $table->tinyInteger('workshop_sign')->default(0)->comment('是否签字 0表示未签 1表示已签')->nullable(); 

            $table->integer('device_leader')->default(0)->comment('设备科长签字')->nullable();
            $table->integer('device_sign')->default(0)->comment('是否签字 0表示未签 1表示已签')->nullable();

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
        Schema::dropIfExists('disclosures');
    }
}
