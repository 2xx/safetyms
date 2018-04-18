<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('project', ProjectController::class);  // 项目
    $router->resource('proinfo', ProInfoController::class);  
    $router->resource('tender',  TenderController::class);   // 申请
    $router->resource('department', DepartmentController::class); // 部门
    $router->resource('tenderfile', TenderFileController::class); // 部门

    $router->get('tender/project/index', 'TenderController@projectindex');
    $router->get('tender/maketender/{projectid}', 'TenderController@makeTender');  // 创建 申请记录  申请_文件记录
    $router->get('tender/accepted/{tender_id}', 'TenderController@setAccepted');
    $router->get('tender/commit/{tender_id}', 'TenderController@commit');   // 申请提交
    // $router->get('tenderfile/{projectid}', 'TenderFileController@edit');  // 上传 项目申请  相关档案资料

    $router->get('project/{id}/checktable', 'ProjectController@checkTable');  // 外来单位安全管理情况审核表
    $router->get('project/{id}/safetycard', 'ProjectController@safetycard');  // 安全传递卡
    $router->get('project/{id}/disclosure', 'ProjectController@disclosure');  // 安全交底记录表

    $router->post('project/{id}/update/checktable', 'ProjectController@updatechecktable');  // 更新-外来单位安全管理情况审核表
    $router->post('project/{id}/update/safetycard', 'ProjectController@updatesafetycard');  // 更新-安全传递卡
    $router->post('project/{id}/update/disclosure', 'ProjectController@updatedisclosure');  // 更新-安全交底记录表

    $router->get('tenderlist/{id}', 'ProjectController@tenders');     // 查看指定项目的申请列表
    $router->get('tenderfile/{id}/list', 'ProjectController@showfiles');  // 查看指定申请的所有上传资料

    $router->get('checktable/{id}/verifier/sign',        'CheckTableController@verifierSign');      // 审核表 审核人签字
    $router->get('checktable/{id}/verifier_leader/sign', 'CheckTableController@verifierLeadrSign'); // 审核表 领导签字

    $router->get('safetycard/{id}/manager_name/sign',      'SafetyCardController@mangerNameSign');       // 传递卡 主管领导签字
    $router->get('safetycard/{id}/workshop_leader/sign',   'SafetyCardController@workshopLeaderSign');   // 传递卡 车间主作签字
    $router->get('safetycard/{id}/safety_section/sign',    'SafetyCardController@safetySectionSign');    // 传递卡 安全科签字
    $router->get('safetycard/{id}/safety_department/sign', 'SafetyCardController@safetyDepartmentSign'); // 传递卡 安全部签字

    $router->get('disclosure/{id}/manager_name/sign',    'DisclosureController@managerNameSign');      // 交底记录 主管领导签字
    $router->get('disclosure/{id}/workshop_leader/sign', 'DisclosureController@workershopLeaderSign'); // 交底记录 车间主任签字
    $router->get('disclosure/{id}/device_leader/sign',   'DisclosureController@deviceLeaderSign');         // 交底记录 设备科长签字

});
