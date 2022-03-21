<?php
//后台管理首页
//作者QQ：1833742775
//官方演示站：www.heike.pw
//官方QQ交流群：458130353
error_reporting(0);
include "config.php";
include "nav.php";
include "ini.php";
include "ini1.php";
include "ini2.php";
include "ini3.php";
include "ini4.php";
include "ini5.php";
include "tool.php";
$token=md5($admin_user.md5($admin_pwd).'4#4!@%');
if(empty($_COOKIE['token']) || $_COOKIE['token']!=$token)
	exit('<script type="text/javascript">window.location.href="login.php";</script>');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, ini1tial-scale=1"/>
  <title><?php echo $ini['title']?> </title>
 <meta name="keywords" content="<?php echo $ini['keywords']?>" />
<meta name="description" content="<?php echo $ini['description']?>" />
 <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="public/js/api.js"></script>
	<?=$script?>
	<link rel="shortcut icon" href="favicon.ico">
    <link href="css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">
    <link href="/css/style.min862f.css?v=4.1.0" rel="stylesheet">
</head>
<body>
   <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
     <div class="panel panel-primary">
       <div class="panel-heading"><h3 class="panel-title">IF导航管理中心首页</h3></div>
         <ul class="list-group">
           <li class="list-group-item"><span class="glyphicon glyphicon-home">
		   </span> 
		   <a href="./index.php" class="btn btn-xs btn-primary">返回首页</a>
		   <a href="./set.php" class="btn btn-xs btn-primary">网站设置</a>
		   <a href="./lun.php" class="btn btn-xs btn-success">评论设置</a>
         </ul>
     </div>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">服务器信息</h3>
	</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) 
{
	echo '线程安全';
}
else 
{
	echo '非线程安全';
}
?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php echo $mysqlversion ?>
		</li>
		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size');
?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize');
?>
		</li>
	</ul>
</div>
   </div>
 </div>
