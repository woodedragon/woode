<?php
error_reporting(0);
include "config.php";
include "ini.php";
include "ini1.php";
include "ini2.php";
include "ini3.php";
include "ini4.php";
include "ini5.php";
include "nav.php";
include "tool.php";
$token=md5($admin_user.md5($admin_pwd).'4#4!@%');
if(empty($_COOKIE['token']) || $_COOKIE['token']!=$token)
	exit('<script type="text/javascript">window.location.href="login.php";</script>');
$step=is_numeric($_GET['step'])?$_GET['step']:'1';
if(@$_POST['kfqq'] && @$_POST['title']){
	$text="<?php
 \$ini = array(
  'title'=>'".$_POST['title']."',//网站标题
  'keywords'=>'".$_POST['keywords']."',//网站关键字
  'description'=>'".$_POST['description']."',//网站描述
  'kfqq'=>'".$_POST['kfqq']."',//客服QQ
  'dibu'=>'".$_POST['dibu']."',//底部统计
  'appid'=>'".$_POST['appid']."',//畅言APPid
  'appkey'=>'".$_POST['appkey']."',//畅言APPkey
  );
?>
";
 saveFile("ini.php",$text);
	echo '<meta http-equiv="refresh" content="0">';
}
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

<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
 <body background="yzyhtt.png">
<hr>
	<?php
				echo'
	<form action="?" method="post" class="am-form">
						<label for="text">客服QQ</label>
					 <textarea class="form-control" name="kfqq" rows="1">'.$ini['kfqq'].'</textarea>
						<br>
<label for="text">网站标题</label>
					 <textarea class="form-control" name="title" rows="1">'.$ini['title'].'</textarea>
						<br>
						<label for="text">网站关键字</label>
 <textarea class="form-control" name="keywords" rows="1">'.$ini['keywords'].'</textarea>
						<br>
						<label for="text">网站描述</label>
<textarea class="form-control" name="description" rows="1">'.$ini['description'].'</textarea>
			                        <br>
						<label for="text">底部统计</label>
<textarea class="form-control" name="dibu" rows="1">'.$ini['dibu'].'</textarea>
			                        <br>
                        <label for="text">畅言APPid</label>
					 <textarea class="form-control" name="appid" rows="1">'.$ini['appid'].'</textarea>
						<br>
						<label for="text">畅言APPkey</label>
 <textarea class="form-control" name="appkey" rows="1">'.$ini['appkey'].'</textarea>
						<br>
 <input onclick="return confirm(\'保存成功，请刷新页面查看！\');" type="submit" name="" value="保存设置" class="btn btn-primary btn-block">
<br>
					</form>
				';
		?>
<?php include "foot.php";?>
</body>
</html>

