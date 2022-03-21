<?php
//活动类配置页
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
if(@$_POST['zdmc1'] && @$_POST['zdmc2']){
	$text="<?php
 \$ini3 = array(
  'bymgg'=>'".$_POST['bymgg']."',//页面公告
  'zdmc1'=>'".$_POST['zdmc1']."',//站点名称1
  'zdjs1'=>'".$_POST['zdjs1']."',//站点介绍1
  'zdlj1'=>'".$_POST['zdlj1']."',//站点链接1
  'zdmc2'=>'".$_POST['zdmc2']."',//站点名称2
  'zdjs2'=>'".$_POST['zdjs2']."',//站点介绍2
  'zdlj2'=>'".$_POST['zdlj2']."',//站点链接2
  'zdmc3'=>'".$_POST['zdmc3']."',//站点名称3
  'zdjs3'=>'".$_POST['zdjs3']."',//站点介绍3
  'zdlj3'=>'".$_POST['zdlj3']."',//站点链接3
  'zdmc4'=>'".$_POST['zdmc4']."',//站点名称4
  'zdjs4'=>'".$_POST['zdjs4']."',//站点介绍4
  'zdlj4'=>'".$_POST['zdlj4']."',//站点链接4
  'zdmc5'=>'".$_POST['zdmc5']."',//站点名称5
  'zdjs5'=>'".$_POST['zdjs5']."',//站点介绍5
  'zdlj5'=>'".$_POST['zdlj5']."',//站点链接5
  'zdmc6'=>'".$_POST['zdmc6']."',//站点名称6
  'zdjs6'=>'".$_POST['zdjs6']."',//站点介绍6
  'zdlj6'=>'".$_POST['zdlj6']."',//站点链接6

  );
?>
";
 saveFile("ini3.php",$text);
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
<h1>#教程类配置页#</h1>
</div>
	<?php
				echo'
	<form action="?" method="post" class="am-form">
		            <div class="col-md-12">
						<label for="text">分类页面公告</label>
					 <textarea class="form-control" name="bymgg" rows="1">'.$ini3['bymgg'].'</textarea>
						<br>
					</div>
                    <div class="col-md-4">
						<label for="text">站点名称1</label>
					 <textarea class="form-control" name="zdmc1" rows="1">'.$ini3['zdmc1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍1</label>
					 <textarea class="form-control" name="zdjs1" rows="1">'.$ini3['zdjs1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接1</label>
					 <textarea class="form-control" name="zdlj1" rows="1">'.$ini3['zdlj1'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点名称2</label>
					 <textarea class="form-control" name="zdmc2" rows="1">'.$ini3['zdmc2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍2</label>
					 <textarea class="form-control" name="zdjs2" rows="1">'.$ini3['zdjs2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接2</label>
					 <textarea class="form-control" name="zdlj2" rows="1">'.$ini3['zdlj2'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点名称3</label>
					 <textarea class="form-control" name="zdmc3" rows="1">'.$ini3['zdmc3'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍3</label>
					 <textarea class="form-control" name="zdjs3" rows="1">'.$ini3['zdjs3'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接3</label>
					 <textarea class="form-control" name="zdlj3" rows="1">'.$ini3['zdlj3'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点名称4</label>
					 <textarea class="form-control" name="zdmc4" rows="1">'.$ini3['zdmc4'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍4</label>
					 <textarea class="form-control" name="zdjs4" rows="1">'.$ini3['zdjs4'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接4</label>
					 <textarea class="form-control" name="zdlj4" rows="1">'.$ini3['zdlj4'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点名称5</label>
					 <textarea class="form-control" name="zdmc5" rows="1">'.$ini3['zdmc5'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍5</label>
					 <textarea class="form-control" name="zdjs5" rows="1">'.$ini3['zdjs5'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接5</label>
					 <textarea class="form-control" name="zdlj5" rows="1">'.$ini3['zdlj5'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点名称6</label>
					 <textarea class="form-control" name="zdmc6" rows="1">'.$ini3['zdmc6'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点介绍6</label>
					 <textarea class="form-control" name="zdjs6" rows="1">'.$ini3['zdjs6'].'</textarea>
						<br>
					</div>
					<div class="col-md-4">
						<label for="text">站点链接6</label>
					 <textarea class="form-control" name="zdlj6" rows="1">'.$ini3['zdlj6'].'</textarea>
						<br>
					</div>
 <input onclick="return confirm(\'保存成功，请刷新页面查看！\');" type="submit" name="" value="保存设置" class="btn btn-primary btn-block">
<br>
					</form>
				';
		?>
                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
<?php include "foot.php";?>
</body>
</html>

