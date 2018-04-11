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
    // $router->get('tenderfile/{projectid}', 'TenderFileController@edit');  // 上传 项目申请  相关档案资料

    $router->get('project/{id}/checktable', 'ProjectController@checkTable');  // 外来单位安全管理情况审核表
    $router->get('project/{id}/safetycard', 'ProjectController@safetycard');  // 安全传递卡
    $router->get('project/{id}/disclosure', 'ProjectController@disclosure');  // 安全交底记录表

    $router->get('tenderlist/{id}', 'ProjectController@tenders');     // 查看指定项目的申请列表
    $router->get('tenderfile/{id}/list', 'ProjectController@showfiles');  // 查看指定申请的所有上传资料

});
