<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\xadmin\home/../application/admin\view\index\main.html";i:1571379792;s:68:"D:\phpStudy\WWW\xadmin\application\admin\view\common\_container.html";i:1570457892;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit"/><!-- 让360浏览器默认选择webkit内核 -->

    <!-- 全局css -->
    <link rel="shortcut icon" href="__PUBLIC__/static/favicon.ico">
    <link href="__PUBLIC__/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__PUBLIC__/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="__PUBLIC__/static/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/plugins/validate/bootstrapValidator.min.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/animate.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/style.css?v=4.1.0" rel="stylesheet">
     <link rel="stylesheet" href="__PUBLIC__/static/js/plugins/layui/css/layui.css?ver=170803"  media="all">
    
    <link href="__PUBLIC__/static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/plugins/webuploader/webuploader.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/plugins/ztree/zTreeStyle.css" rel="stylesheet">
    <link href="__PUBLIC__/static/css/plugins/jquery-treegrid/css/jquery.treegrid.css" rel="stylesheet"/>
    <!-- <link href="__PUBLIC__/static/css/plugins/ztree/demo.css" rel="stylesheet"> -->

    <!-- 全局js -->
    <script src="__PUBLIC__/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="__PUBLIC__/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="__PUBLIC__/static/js/plugins/ztree/jquery.ztree.all.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/validate/bootstrapValidator.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/validate/zh_CN.js"></script>
    <script src="__PUBLIC__/static/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/jquery-treegrid/js/jquery.treegrid.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/jquery-treegrid/js/jquery.treegrid.bootstrap3.js"></script>
    <script src="__PUBLIC__/static/js/plugins/jquery-treegrid/extension/jquery.treegrid.extension.js"></script>
    <script src="__PUBLIC__/static/js/plugins/layer/layer.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/iCheck/icheck.min.js"></script>
    <script src="__PUBLIC__/static/js/plugins/layer/laydate/laydate.js"></script>
    <script src="__PUBLIC__/static/js/plugins/webuploader/webuploader.min.js"></script>
    <script src="__PUBLIC__/static/js/common/ajax-object.js"></script>
    <script src="__PUBLIC__/static/js/common/bootstrap-table-object.js"></script>
    <script src="__PUBLIC__/static/js/common/tree-table-object.js"></script>
    <script src="__PUBLIC__/static/js/common/web-upload-object.js"></script>
    <script src="__PUBLIC__/static/js/common/ztree-object.js"></script>
    <script src="__PUBLIC__/static/js/common/Feng.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/js/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" src="__PUBLIC__/static/js/xheditor/xheditor-1.2.2.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/js/xheditor/xheditor_lang/zh-cn.js"></script>
    <script type="text/javascript">
		
        Feng.addCtx("<?php echo str_replace('.html','',url('@'.request()->module()))?>");
        Feng.sessionTimeoutRegistry();
    </script>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
	
<div style="background-color:#FFF; padding-top:10px; margin-top:-15px;" class="container-fluid"
	style="padding: 0 !important;">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-success alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<?php echo session('admin.username'); ?>，欢迎使用<?php echo config('site_title'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<table class="table table-bordered" "> 
				<tbody>
					<tr> 
						<td style=" background-color:#F5F5F6; font-weight:bold; text-align:left">系统信息</td>
				<td></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">网站域名：</td>
					<td>http://<?php echo $_SERVER['SERVER_NAME']; ?></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">服务IP：</td>
					<td><?php echo $_SERVER['SERVER_ADDR']; ?>:<?php echo $_SERVER['SERVER_PORT']; ?></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">php版本：</td>
					<td><?php echo phpversion(); ?></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">物理路径：</td>
					<td><?php echo dirname(THINK_PATH); ?></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">运行环境：</td>
					<td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">上传大小：</td>
					<td> <?php echo get_cfg_var( "upload_max_filesize")?get_cfg_var( "upload_max_filesize"): "不允许上传文件" ; ?>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
		<div class="col-lg-6">
			<table class="table table-bordered" "> 
				<tbody>
					<tr> 
						<td style=" background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">程序版本：</td>
				<td>4.5.0</td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">开发团队：</td>
					<td>乐腾科技</td>
				</tr>
				<tr>
					<td style="background-color:#F5F5F6; font-weight:bold; text-align:left" width="30%">联系QQ：</td>
					<td>1149365497</td>
				</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

</div>
<script src="__PUBLIC__/static/js/content.js?v=1.0.0"></script>

</body>
</html>
