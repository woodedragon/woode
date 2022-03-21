<?php
include "config.php";
include "ini.php";
include "tool.php";
include "nav.php";
$token=md5($admin_user.md5($admin_pwd).'4#4!@%');
if(empty($_COOKIE['token']) || $_COOKIE['token']!=$token)
	exit('<script type="text/javascript">window.location.href="login.php";</script>');
?>
<?php
include "nav.php";
echo '<!DOCTYPE html>
<html lang="zh-cn">
 <head>
   <meta charset="utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1"/>
   <title>IF网站导航系统手动更新页面</title>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
 <body background="yzyhtt.png">

</head>
<body>
   ';
if(!isset($_GET['install']))
{
	;
	echo '    <p>
   </p>
   <h3>更新功能暂未完善 请各位站长自行对比版本</h3>
<p><iframe src="http://auth.heike.pw/update/readme1.0.txt" style="width:100%;height:250px;"></iframe></p>
<p align="center"><a class="btn btn-primary" href="';
	echo $_SERVER['PHP_SELF'];
	echo '?install"/>点击这里开始自动更新</a></p>
   ';
}
else
{
	if(ini_get('allow_url_fopen') &&class_exists('ZipArchive'))
	{
		if($file = file_get_contents('http://auth.heike.pw/update/update.zip'))
		{
			echo '<h4>下载程序成功</h4>';
		}
		else
		{
			echo '<h4>下载程序失败</h4>';
			exit;
		}
		if(file_put_contents('update.zip',$file))
		{
			echo '<h4>保存程序成功 最新更新压缩包目录/inc/update.zip</h4>';
		}
		else
		{
			echo '<h4>保存程序失败！<br/>可能脚本没有写入权限。</h4>';
		}
		echo '<p><a href="./">点击这里返回</a><hr/><pre>'.file_get_contents('/readme.txt').'</pre></p>';
	}
	else
	{
		;
		echo '    <p>
     由于功能问题，该脚本无法在您的空间运行。<br/>
     错误：无法打开远程文件或<b>ZipArchive</b>类不存在！
   </p>
   ';
	}
}
;
echo '  </body>
</html>
';
?>
