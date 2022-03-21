<?php

error_reporting(0);
include "config.php";
include "ini.php";
include "tool.php";
if(!empty($_GET['action'])){
	if(empty($_POST['name']) or empty($_POST['pass'])){
		echo '喝多了？啥都不写你想干啥？？？<br/>';
	}else{
		if($_POST['name']==$admin_user && $_POST['pass']==$admin_pwd){
			$token=md5($admin_user.md5($admin_pwd).'4#4!@%');
			echo '<script language="javascript" type="text/javascript">
					document.cookie="token='.$token.'";
           			window.location.href="index.php";
    			</script>';
		}else
			echo '非管理员禁止进入！！！<br/>';
		
	}
exit();
}
?>
<!DOCTYPE html>
<html>
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
   <script>
   $(document).keypress(function(e) { 
    // 回车键事件 
    if(e.which == 13) { 
   		jQuery("#login").click(); 
       } 
   }); 
	$(document).ready(function(){
	  $('#login').click(function(){
	  	$("#login").button('loading');
	    $.post("login.php?action=save",
	    {
	      name:$('#name').val(),
	      pass:$('#pass').val(),
	    },
	    function(data,status){
	      $("#login").button('reset');
	      $('#result').html(data);
	    });
	  });
	});
	</script>
</head>
<body style="width:80%;height:100%;margin:0 auto;">

<div class="" style="padding: 10px 10px 10px;margin-top:2%;">

	<div class="page-header">
   <h1>IF网站导航系统 管理员登陆
   </h1>
	</div>

	<p id="result" style="color:red;text-align:center;"></p>
   <form class="bs-example bs-example-form" role="form">
      <div class="input-group">
         <span class="input-group-addon">管理员名称</span>
         <input id="name" type="text" class="form-control" placeholder="管理员名称">
      </div>
      <br>
      <div class="input-group">
         <span class="input-group-addon">管理员密码</span>
         <input id="pass" type="password" class="form-control" placeholder="管理员密码">
      </div>
	<br/>
    <button type="button" class="btn btn-primary btn-lg btn-block" id="login" 
	   data-complete-text="Loading finished">登陆后台
	</button>

   </form>
</div>

</body>
</html>
