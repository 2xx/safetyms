<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tender_files', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('tender_id')->comment('申请编号')->nullable();

            $table->string('license',255)->comment('营业执照')->nullable();
            $table->string('certificate',255)->comment('等级证书')->nullable();
            $table->string('authorization',255)->comment('授权书')->nullable();
            $table->string('legal_cert',255)->comment('法人证书')->nullable();
            $table->string('special_cert',255)->comment('特种作业证')->nullable();
            $table->string('device_report',255)->comment('设备报告')->nullable();
            $table->string('job_resume',255)->comment('施工简历')->nullable();
            $table->string('safety_protocol',255)->comment('安全管理协议')->nullable();
            $table->string('safety_cart',255)->comment('安全传递卡')->nullable();
            $table->string('safety_record',255)->comment('安全交底记录')->nullable();
            $table->string('safety_responsibility',255)->comment('安全生产责任制')->nullable();
            $table->string('safety_regulations',255)->comment('安全管理规章制度')->nullable();
            $table->string('safety_sop',255)->comment('安全操作规程')->nullable();
            $table->string('emergency_rescue_plan',255)->comment('应急救援预案')->nullable();
            $table->string('safety_net_diagram',255)->comment('安全管理网络图')->nullable();
            $table->string('safety_worker_cert',255)->comment('安全管理员证书')->nullable();
            $table->string('worker_medical',255)->comment('从业人员体检表')->nullable();
            $table->string('labor_contract',255)->comment('劳动合同及工伤保险签订和缴纳证明')->nullable();
            $table->string('safety_training',255)->comment('安全培训记录')->nullable();
            $table->string('electric_ticket',255)->comment('临时用电审批证明')->nullable();
            $table->string('construction_scheme',255)->comment('施工方案和技术措施')->nullable();
            $table->string('safety_inspection',255)->comment('施工现场安检记录')->nullable();
            $table->string('inspection_record',255)->comment('验收记录')->nullable();
            $table->string('other_files',255)->comment('其他存档资料')->nullable();
            
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
        Schema::dropIfExists('tender_files');
    }
}
