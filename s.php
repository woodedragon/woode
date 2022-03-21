<?php
include('Template/header.php');
if($config['关闭站点']=="true"){
    die("<h3 style='width:100vw;text-align:center;margin-top:80px;'>网站维护中，开放时间另行通知！</h3>");
}
header("Cache-Control: max-age=86400");
?>
<!--导航列表-->
<div class="navs">
	<ul class="list" style="border-radius: 10px;">
	    <li><a href="javascript:(0)">位置：</a></li>
        <li><a href="/">首页</a></li>
        <li><a href="javascript:(0)">/</a></li>
        <li><a href="/?c=<?php echo $category; ?>"><?php echo $category; ?></a></li>
        <li><a href="javascript:(0)">/</a></li>
        <li><a href="/s.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></li>
    </ul>
</div>
<!-- 内容开始 -->
<div class="t1" style="height:auto">
	<div class="t2" style="margin: 0 auto;">
	    <!--标题-->
		<h2 style="margin-top: 10px;margin: 10px;"><? echo $title; ?></h2>
		<!--浏览量/tag-->
		<p class="fa fa-clock-o" style="margin-top: 10px;margin: 10px;font-size:12px">&nbsp;<?php echo filetime("/Article/".$id.".php"); ?>&nbsp;&nbsp;浏览量：（<?php  echo $views; ?>）&nbsp;&nbsp;标签:&nbsp;<?php echo $keywords; ?>&nbsp;</p><br />
	</div>
	<!--内容-->
    <div id="content" >
        <div style="padding:10px">
          <?php echo $data; ?>
          <!--版权声明-->
        <br /><br />本文由【<?php echo $config['网站标题'];?>】原创，转载请注明出处，违者必究：<a href="<?php echo geturls(); ?>" title="<?php echo $title; ?>"><?php echo geturls(); ?></a><br />
        </div>
    </div>
</div>
<!-- 内容结束 -->
<?php include('Template/footer.php'); ?>