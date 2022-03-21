<?php
//首页面配置页
//作者QQ：1833742775
//官方演示站：www.heike.pw
//官方QQ交流群：458130353
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
if(@$_POST['ydw1'] && @$_POST['ydt1']){
	$text="<?php
 \$ini1 = array(
  'ydt1'=>'".$_POST['ydt1']."',//引导图1
  'ydw1'=>'".$_POST['ydw1']."',//引导文1
  'ydl1'=>'".$_POST['ydl1']."',//引导链1
  'ydt2'=>'".$_POST['ydt2']."',//引导图2
  'ydw2'=>'".$_POST['ydw2']."',//引导文2
  'ydl2'=>'".$_POST['ydl2']."',//引导链2
  'ydt3'=>'".$_POST['ydt3']."',//引导图3
  'ydw3'=>'".$_POST['ydw3']."',//引导文3
  'ydl3'=>'".$_POST['ydl3']."',//引导链3
  'xxw1'=>'".$_POST['xxw1']."',//信息文1
  'xxw2'=>'".$_POST['xxw2']."',//信息文2
  'xxw3'=>'".$_POST['xxw3']."',//信息文3
  'xxw4'=>'".$_POST['xxw4']."',//信息文4

  );
?>
";
 saveFile("ini1.php",$text);
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-block" style="float: none;">
<body background="yzyhtt.png">
<h1>#首页面配置页#</h1>
</div>
	<?php
				echo'
	<form action="?" method="post" class="am-form">
                    <div class="col-md-4">
						<label for="text">引导图1图片地址</label>
					 <textarea class="form-control" name="ydt1" rows="1">'.$ini1['ydt1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导文1</label>
					 <textarea class="form-control" name="ydw1" rows="1">'.$ini1['ydw1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导链1</label>
					 <textarea class="form-control" name="ydl1" rows="1">'.$ini1['ydl1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导图2</label>
					 <textarea class="form-control" name="ydt2" rows="1">'.$ini1['ydt2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导文2</label>
					 <textarea class="form-control" name="ydw2" rows="1">'.$ini1['ydw2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导链2</label>
					 <textarea class="form-control" name="ydl2" rows="1">'.$ini1['ydl2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导图3</label>
					 <textarea class="form-control" name="ydt3" rows="1">'.$ini1['ydt3'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导文3</label>
					 <textarea class="form-control" name="ydw3" rows="1">'.$ini1['ydw3'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">引导链3</label>
					 <textarea class="form-control" name="ydl3" rows="1">'.$ini1['ydl3'].'</textarea>
						<br>
					</div>
					<div class="col-md-12">
						<label for="text">信息文1</label>
					 <textarea class="form-control" name="xxw1" rows="1">'.$ini1['xxw1'].'</textarea>
						<br>
					</div>
					<div class="col-md-12">
						<label for="text">信息文2</label>
					 <textarea class="form-control" name="xxw2" rows="1">'.$ini1['xxw2'].'</textarea>
						<br>
					</div>
					<div class="col-md-12">
						<label for="text">信息文3</label>
					 <textarea class="form-control" name="xxw3" rows="1">'.$ini1['xxw3'].'</textarea>
						<br>
					</div>
					<div class="col-md-12">
						<label for="text">信息文4</label>
					 <textarea class="form-control" name="xxw4" rows="1">'.$ini1['xxw4'].'</textarea>
						<br>
					</div>
 <input onclick="return confirm(\'保存成功，请刷新页面查看！\');" type="submit" name="" value="保存设置" class="btn btn-primary btn-block">
<br>
					</form>
				';
		?>
<?php include "foot.php";?>
</body>
</html>

