<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>安全管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/vendor/laravel-admin/font-awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/dist/css/skins/skin-blue-light.min.css">

    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-fileinput/css/fileinput.min.css?v=4.3.7">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.skinNice.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css">

    <link rel="stylesheet" href="/vendor/laravel-admin/laravel-admin/laravel-admin.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/nprogress/nprogress.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/nestable/nestable.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/google-fonts/fonts.css">
    <link rel="stylesheet" href="/vendor/laravel-admin/AdminLTE/dist/css/AdminLTE.min.css">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="/vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/laravel-admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/vendor/laravel-admin/AdminLTE/dist/js/app.min.js"></script>
    <script src="/vendor/laravel-admin/jquery-pjax/jquery.pjax.js"></script>
    <script src="/vendor/laravel-admin/nprogress/nprogress.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition skin-blue-light sidebar-mini">
   
<div class="wrapper">

    <!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="/admin/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>管</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>安全管理</b> 系统</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      
    </nav>
</header>
    @section('main') 
    <div class="container" id="pjax-container">
            <section class="content-header">
        <h1>
            外委单位注册
            <small>创建</small>
        </h1>

        <!-- breadcrumb start -->
                <!-- breadcrumb end -->

    </section>

    <section class="content">

                                
        <div class="row"><div class="col-md-12"><div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">创建</h3>

        <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 10px">
    <a href="/admin/project" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
</div> <div class="btn-group pull-right" style="margin-right: 10px">
    <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
</div>
        </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form action="/reg" method="POST" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" >
        {!! csrf_field() !!}
        <div class="box-body">

                <div class="fields-group">

                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                
                                <input type="text" id="pname" name="username" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>

                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                
                                <input type="text" id="pname" name="password" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>

                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">确认密码</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                
                                <input type="text" id="pname" name="repassword" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>

                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">企业名称</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                
                                <input type="text" id="pname" name="name" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">地址</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">联系电话</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">法人</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">注册资金</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-yen"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">经营范围</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
                    <div class="form-group  ">

                        <label for="pname" class="col-sm-2 control-label">组织机构代码</label>

                        <div class="col-sm-8">

                            
                            <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                
                                <input type="text" id="pname" name="" value="" class="form-control pname" placeholder="" />

                                
                            </div>

                            
                        </div>
                    </div>
    

                                            

                </div>
            
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

                
                        <div class="col-md-2">

            </div>
            <div class="col-md-8">

                <div class="btn-group pull-right">
    <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> 提交">提交</button>
</div>

                <div class="btn-group pull-left">
    <button type="reset" class="btn btn-warning">撤销</button>
</div>

            </div>

        </div>

        
        <!-- /.box-footer -->
    </form>
</div>

</div></div>

    </section>
        <script data-exec-on-popstate>

    $(function () {
                    $('.form-history-back').on('click', function (event) {
    event.preventDefault();
    history.back(1);
});
                    $('.state').iCheck({radioClass:'iradio_minimal-blue'});
            });
</script>
    </div>
@show
    <!-- Main Footer -->
    <footer class="main-footer" style="margin-left: 0px;bottom:0px;text-align: center;">
    <!-- To the right -->
   
       <strong>Powered by <a href="https://github.com/z-song/laravel-admin" target="">laravel-admin</a></strong>
        <strong>Version</strong>&nbsp;&nbsp; 1.5.x-dev
 
    <!-- Default to the left -->
    
</footer>

</div>

<!-- ./wrapper -->

<script>
    function LA() {}
    LA.token = "NsRfcR3A9Lau3r9C7N5iN8CliG2hjnRtFEcaMmv5";
</script>

<!-- REQUIRED JS SCRIPTS -->
<script src="/vendor/laravel-admin/nestable/jquery.nestable.js"></script>
<script src="/vendor/laravel-admin/toastr/build/toastr.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/vendor/laravel-admin/sweetalert/dist/sweetalert.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="/vendor/laravel-admin/moment/min/moment-with-locales.min.js"></script>
<script src="/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js?v=4.3.7"></script>
<script src="/vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js?v=4.3.7"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script src="/vendor/laravel-admin/number-input/bootstrap-number-input.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/vendor/laravel-admin/AdminLTE/plugins/ionslider/ion.rangeSlider.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/vendor/laravel-admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js"></script>
<script src="/vendor/laravel-admin/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js"></script>

<script src="/vendor/laravel-admin/laravel-admin/laravel-admin.js"></script>

</body>