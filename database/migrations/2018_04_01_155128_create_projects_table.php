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
            $table->string('pname')->comment('项目名称');
            $table->integer('publish_time')->comment('发布时间');
            $table->integer('start_time')->comment('开始时间');
            $table->integer('end_time')->comment('结束时间');
            $table->integer('state')->comment('1未发布 2已发布 3结束');
            $table->string('content_id')->comment('需要提交资料的ID,用逗号隔开');
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
