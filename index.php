<?php
include('Template/header.php');
if($config['关闭站点']=="true"){
    die("<h3 style='width:100vw;text-align:center;margin-top:80px;'>网站维护中，开放时间另行通知！</h3>");
}
$c = @$_REQUEST['c'];
?>
		<input id="search" class="nav" type="text" value="" placeholder="请输入搜索关键字" />
		<!--导航列表-->
		<div class="nav">
			<ul class="list" style="border-radius: 10px;">
                <?php
                
                $li = strlen($c)<=0 ? "<li class=\"avr\"><a href=\"/\">首页</a></li>" : "<li><a href=\"/\">首页</a></li>";
			    for ($i = 0; $i < count($config['分类']); $i++) {
			        
	                if($c==$config['分类'][$i]){
	                 $li.= "<li class=\"avr\"><a href=\"/?c=".$config['分类'][$i]."\">".$config['分类'][$i]."</a></li>";
	                }else{
	                 $li.= "<li><a href=\"/?c=".$config['分类'][$i]."\">".$config['分类'][$i]."</a></li>";
	                }
                         
			    }
			    echo $li;unset($li);
            ?>
</ul>
        </div>
<div style="width: 100%; ">
	<ul id="list" style="width:96%;margin: 0 auto;margin-top: 10px;">
	    <?php
	    $article=@strlen($c)<=0 ? rdata("/Admin/Config/indexes.php") : rdata("/Category/".$c.".php");
	    $articlelenght=count($article);
	    $pageall=ceil($articlelenght/18);
	    $p=@$_REQUEST['p']>0 ? $_REQUEST['p'] : 1;
	    $p=$p>$pageall ? 1 : $pageall;
	    $page=ceil($p*18);
	    $pages=$page-18;
	    $articlekey=array_reverse(array_keys($article));
	    $articlelenght=count($article);
	    
	    for ($i = $pages; $i < $page; $i++) {
	        $id=@$articlekey[$i];
	       // print_r(rdata("/Article/".$id.".php")['0']);
	       // $c=$articlekey[$i]['c'];
	        $bodys = @mb_substr(strip_tags(rdata("/Article/".$id.".php")['0']),0,128,'utf-8');
	        if($id and $bodys){
	        echo "<li>".
			"<h2><a href=\"/s.php?id=".$id."\" title=\"".$article[$articlekey[$i]]['t']."\" >".$article[$articlekey[$i]]['t']."</a></h2><br />".
			"<p>".$bodys."</p><br />".
			"<small class=\"fb\"><span style=\"font-size:18px\">⏱&nbsp;</span>".filetime("/Article/".$id.".php")."</small><br />".
		"</li>";
	        }
	    }
	    
	    ?>
        

	</ul>
</div>
      
      <div align="center" style='margin-top:20px;'>
          <a href="/" title="首页" class="btn">首页</a>
          <a href="/?p=<?php echo ($p-1)."&c=".$c; ?>" title="上一页" class="btn">上一页</a>
          <a href="/?p=<?php echo $p."&c=".$c; ?>" title="当前页" class="btn avr">1</a>
          <a href="/?p=<?php echo ($p+1)."&c=".$c; ?>" title="下一页" class="btn">下一页</a>
          <a href="/?p=<?php echo $pageall."&c=".$c; ?>" title="尾页" class="btn">尾页</a>
      </div>

<?php
include('Template/footer.php');
?>