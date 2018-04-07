<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('project', ProjectController::class);
    $router->resource('proinfo', ProInfoController::class);
    $router->resource('tender',  TenderController::class);

    $router->get('tender/project/index', 'TenderController@projectindex');
    $router->get('tender/maketender/{projectid}', 'TenderController@makeTender');  // 创建 申请记录  申请_文件记录
    $router->get('tender/upload/{projectid}', 'TenderFileController@uploads');  // 上传 项目申请  相关档案资料

    $router->get('project/{id}/checktable', 'ProjectController@checkTable');

});
