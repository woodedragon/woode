<?php
error_reporting(0);
$config = rdata("/Admin/Config/config.php");
if($_COOKIE["user"] and $_COOKIE["oo"]){
    if($_COOKIE["user"]==$config["管理账号"] and $_COOKIE["oo"]==$config["管理密码"]){}else{die(0);}
}else{
    die(0);
}
//恢复网站默认基础信息
function Webconfig(){
    $webdata = array(
    "网站标题" => "博你blog-再快一点的轻博客",
    "关键词" => "博你blog,迷你博客,洁癖控博客，小型博客，轻型博客，轻博客",
    "描述" => "博你blog是一款极度精简的轻型博客系统，不管是从前台到后台都以很少的代码量完成，运行速度比起臃肿的框架更具有挑战性，合理规划的站内seo分布，使您的网站排名更进一步，加载速度也更胜一筹。",
    "客服" => "657258535",
    "版权" => "Copyright ©2019 博你BLOG",
    "网站简介" => "本博客开源，纯PHP+TXT编写，速度快，体积小，在网站底部下载。",
    "网站背景色" => "#00C5CD",
    "网站透明度" => "2",
    "网站字体颜色" => "#f8f8f8",
    "关闭站点" => "false",
    "管理账号" => "admin",
    "管理密码" => pass("admin"),
    "分类" => array(
        "默认分类"
        )
    );
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/config.php","<? exit; ?>".PHP_EOL.json_encode($webdata,JSON_UNESCAPED_UNICODE));
}

function filetime($path){
    return date("Y-m-d H:i:s",filectime($_SERVER['DOCUMENT_ROOT'].$path));
}

function pass($pass){
    for ($i = 0; $i < 99; $i++) {
         $pass=md5($pass);
    }
    return $pass;
}

//读取数据
function rdata($path){
    $articles=explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'].$path));
    // echo "<pre>";print_r($articles['1']);echo "</pre>";exit;
    return json_decode($articles['1'],true);//解码并以数组返回，取消true则为->对象
}
//储存数据
function wdata($path,$arr=array()){
    file_put_contents($_SERVER['DOCUMENT_ROOT'].$path,"<?php exit; ?>"."\n".json_encode($arr,JSON_UNESCAPED_UNICODE));
}
//新增文章
if($_REQUEST['t']=="addArticle"){

    if( strlen($_REQUEST['c'])>0 and strlen($_REQUEST['title'])>0 and strlen($_REQUEST['k'])>0 ){

        $c=$_REQUEST['c'];
        $t=$_REQUEST['title'];
        $k=$_REQUEST['k'];
        $b=array($_REQUEST['b']);

        $indexes = rdata("/Admin/Config/indexes.php");//读取索引数据
        $i=true;//执行循环

        while($i==true){
            $id = mt_rand(10000000,99999999);//创建文章ID
            if($indexes[$id]){
                //文章ID存在，获取新ID
            }else{
                $i=false;//文章ID符合条件，停止循环
            }
        }//循环结束
        $indexes[$id] = array(
            "c" => $c,
            "t" => $t//添加标题索引，用于搜索站内文章
        );

        wdata("/Admin/Config/indexes.php",$indexes);//写入索引数据
        unset($indexes);//清理内存
        $article = rdata("/Category/".$c.".php");//读取文章数据
        $article[$id] = array(//添加文章索引
            "t" => $t,//title
            "k" => $k,//keywords,tag 为了SEO考虑不设置关键词条件不通过
            "v" => 0
        );
        wdata("/Category/".$c.".php",$article);//写入文章索引
        unset($article);//清理内存
        wdata("/Article/".$id.".php",$b);//写入文章索引
        echo 1;
        sitemaps();
    }
}

//修改文章
if($_REQUEST['t']=="upArticle"){

    if(strlen($_REQUEST['id'])>0 and strlen($_REQUEST['c'])>0 and strlen($_REQUEST['title'])>0 and strlen($_REQUEST['k'])>0 ){
        $id=$_REQUEST['id'];
        $c=$_REQUEST['c'];
        $t=$_REQUEST['title'];
        $k=$_REQUEST['k'];
        $b=array($_REQUEST['b']);

        $indexes = rdata("/Admin/Config/indexes.php");//读取索引数据
        
        $indexes[$id] = array(
            "c" => $c,
            "t" => $t//添加标题索引，用于搜索站内文章
        );

        wdata("/Admin/Config/indexes.php",$indexes);//写入索引数据
        unset($indexes);//清理内存
        $article = rdata("/Category/".$c.".php");//读取文章数据
        $article[$id] = array(//添加文章索引
            "t" => $t,//title
            "k" => $k
        );
        wdata("/Category/".$c.".php",$article);//写入文章索引
        unset($article);//清理内存
        wdata("/Article/".$id.".php",$b);//写入文章索引
        echo 1;
    }
}
//删除文章
if($_REQUEST['t']=="delArticle"){
    //id Category 
    if( strlen($_REQUEST['id'])>0){
    $id=$_REQUEST['id'];
    $indexes = rdata("/Admin/Config/indexes.php");//读取索引数据
    $c=$indexes[$id]['c'];
    unset($indexes[$id]);//
    wdata("/Admin/Config/indexes.php",$indexes);//写入索引数据
    unset($indexes);//清理内存
    $article = rdata("/Category/".$c.".php");//读取文章数据
    unset($article[$id]);
    wdata("/Category/".$c.".php",$article);//写入文章索引
    unset($article);//清理内存
    unlink("../../Article/".$id.".php");
    echo 1;
    sitemaps();
    }else{
        return false;
    }
}
//后台文章管理
if($_REQUEST['t']=="Article"){
    $article=rdata("/Admin/Config/indexes.php");
    $articlekey=array_reverse(array_keys($article));
    $articlelenght=count($article);
    $listlenght=ceil($articlelenght/18);
    $p = (int)$_REQUEST['p'] ? (int)$_REQUEST['p'] : 1;
    if($p<0 or $p>$listlenght){
        $p=1;
    }
    $page=$p*18;
    $page=$page > $articlelenght ? $articlelenght : $page;
    $pages=$page-18;
    $pgs=$p-1;$pgs=$pgs<=0?1:$pgs;
    $pgx=$p+1;$pgx=$pgx>$listlenght?$listlenght:$pgx;
    
    $str = "";
    for ($i = $pages; $i < $page; $i++) {
        $id=@$articlekey[$i];
        // $bodys = mb_substr(strip_tags(rdata("/Article/".$id.".php")['0']),0,128,'utf-8');
        if($id){
            $str.= "<tr><td >".$article[$articlekey[$i]]['c']."</td> ".
    		"<td >".$article[$articlekey[$i]]['t']."</td> ".
    		"<td >".filetime("/Article/".$id.".php")."</td> ".
            "<td style=\"text-align:center\" ><a class='btn' href='javascript:(0);' onclick='upArticle(".$id.")'>编辑</a>&nbsp;&nbsp;<a class='btn' href='javascript:(0);' onclick='delArticle(".$id.")'>删除</a></td>".
            "</tr>";
        }
    }
    $str .= '<tr><td style="width:100%;text-align:center;">'.
          '<a href="javascript:(0)" title="首页" class="btn" onclick="page(1)">首页</a>'.
          '<a href="javascript:(0)" title="上一页" class="btn" onclick="page('.$pgs.')">上一页</a>'.
          '<a href="javascript:(0)" title="当前页" class="btn avr">'.$p.'</a>'.
          '<a href="javascript:(0)" title="下一页" class="btn" onclick="page('.$pgx.')">下一页</a>'.
          '<a href="javascript:(0)" title="尾页" class="btn" onclick="page('.$listlenght.')">尾页</a></td></tr>';
    // echo $pgs."|".$pgx."|".$listlenght;
    unset($article,$articlekey,$articlelenght);
    echo $str;
}
//新增分类
if($_REQUEST['t']=="addCategory"){
    ///Admin/Config/post.php?t=addCategory&cname=技术
    if(strlen($_REQUEST['cname'])>0){
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/Category/".$_REQUEST['cname'].".php")){
            echo 1;die;
        }
        $Category = rdata("/Admin/Config/config.php");
        array_push($Category['分类'],$_REQUEST['cname']);
        wdata("/Admin/Config/config.php",$Category);
        //写入新分类文件
        wdata("/Category/".$_REQUEST['cname'].".php");
        echo 1;
    }
}
//更新分类
if($_REQUEST['t']=="upCategory"){
    ///Admin/Config/post.php?t=upCategory&cname=技术&newcname=news
    if(strlen($_REQUEST['cname'])>0 and strlen($_REQUEST['newcname'])>0){
    $Category = rdata("/Admin/Config/config.php");
    $Categorylenght = count($Category['分类']);
    for ($i = 0; $i < $Categorylenght; $i++) {
        if($Category['分类'][$i]==$_REQUEST['cname']){
            $Category['分类'][$i]=$_REQUEST['newcname'];
        }
    }
    wdata("/Admin/Config/config.php",$Category);
    //更新分类文章并重命名文件
    $article = rdata("/Admin/Config/indexes.php");
    $articlelenght = count($article);
    $articlekey=array_keys($article);
    for ($i = 0; $i < $articlelenght; $i++) {
        if($article[$articlekey[$i]]['c']==$_REQUEST['cname']){
            $article[$articlekey[$i]]['c']=$_REQUEST['newcname'];
        }
    }
    wdata("/Admin/Config/indexes.php",$article);
    rename ($_SERVER['DOCUMENT_ROOT']."/Category/".$_REQUEST['cname'].".php", $_SERVER['DOCUMENT_ROOT']."/Category/".$_REQUEST['newcname'].".php");
    echo 1;
    }
}
//删除分类
if($_REQUEST['t']=="delCategory"){
    ///Admin/Config/post.php?t=delCategory&cname=技术
    if(strlen($_REQUEST['cname'])>0){
    $Category = rdata("/Admin/Config/config.php");
    $Categorylenght = count($Category['分类']);
    for ($i = 0; $i < $Categorylenght; $i++) {
        if($Category['分类'][$i]==$_REQUEST['cname']){
            unset($Category['分类'][$i]);//删除配置里面的分类
        }
    }
    $Category['分类']=array_values($Category['分类']);
    wdata("/Admin/Config/config.php",$Category);
    unset($Category);
    //删除索引里面的分类
    $article = rdata("/Category/".$_REQUEST['cname'].".php");
    $articles = rdata("/Admin/Config/indexes.php");
    $articlelenght = count($article);
    for ($i = 0; $i < $articlelenght; $i++) {
       unset($articles[key($article[$i])]);
    }
    unset($article);
    wdata("/Admin/Config/indexes.php",$articles);
    unset($articles);
    unlink($_SERVER['DOCUMENT_ROOT']."/Category/".$_REQUEST['cname'].".php");
    echo 1;
    }
}

if($_REQUEST['t']=="delspider"){
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/spider.csv","蜘蛛,IP,时间,抓取页\r\n");
    echo 1;
}
if($_REQUEST['t']=="userviews"){
    $data=strlen($_REQUEST['data'])>8 ? $_REQUEST['data'] : exit;
    $file=$_SERVER['DOCUMENT_ROOT']."/Admin/Config/userviews.csv";
    $datafile=fopen($file,"a");//打开文本,写入模式
    fwrite($datafile,$data."\r\n");
    fclose($datafile);//关闭文本
    echo 1;
}
if($_REQUEST['t']=="deluserviews"){
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/userviews.csv","客户端,浏览器,IP,地区,运营商,访问页,来源,时间\r\n");
    echo 1;
}

if($_REQUEST['t']=="Webconfig"){
    if($_REQUEST['cd5s1'] and $_REQUEST['cd5s2'] and $_REQUEST['cd5s3'] and $_REQUEST['cd5s4'] and $_REQUEST['cd5s5'] and $_REQUEST['cd5s6'] and $_REQUEST['cd5s7'] and $_REQUEST['cd5s8'] and $_REQUEST['cd5s9'] and $_REQUEST['cd5s10'] and $_REQUEST['cd5s11']){
        $webconfig = rdata("/Admin/Config/config.php");
        $webconfig['网站标题']=$_REQUEST['cd5s1'];
        $webconfig['关键词']=$_REQUEST['cd5s2'];
        $webconfig['描述']=$_REQUEST['cd5s3'];
        $webconfig['客服']=$_REQUEST['cd5s4'];
        $webconfig['版权']=$_REQUEST['cd5s5'];
        $webconfig['网站简介']=$_REQUEST['cd5s6'];
        $webconfig['网站背景色']=$_REQUEST['cd5s7'];
        $webconfig['网站透明度']=$_REQUEST['cd5s8'];
        $webconfig['网站字体颜色']=$_REQUEST['cd5s9'];
        $webconfig['关闭站点']=$_REQUEST['cd5s10'];
        $webconfig['管理账号']=$_REQUEST['cd5s11'];
        if(strlen($_REQUEST['cd5s12'])>5){
            $webconfig['管理密码']=pass($_REQUEST['cd5s12']);
        }
        wdata("/Admin/Config/config.php",$webconfig);
        echo 1;
    }
}
if($_REQUEST['t']=="link"){
    if(@$_REQUEST['data']){
    wdata("/Admin/Config/link.php",array($_REQUEST['data']));
    }
    echo 1;
}
function gethttps($id){
    if (@$_SERVER['HTTPS'] != "on") {
        return "http://".$_SERVER['HTTP_HOST']."/s.php?id=".$id;
    }else{
        return "https://".$_SERVER['HTTP_HOST']."/s.php?id=".$id;;
    }
}

function sitemaps(){
    $article=rdata("/Admin/Config/indexes.php");
	$article=array_keys($article);
	$articlelenght=count($article);
    $map='<?xml version="1.0" encoding="utf-8"?><urlset><!-- Created By http://www.4asport.com ,  URLs: '.$articlelenght.' Generated at: '.date("Y-m-d H:i:s",time()).' -->';
    $maps="";
    for ($i = 0; $i < $articlelenght; $i++) {
        $id = $article[$i];
        $map.='<url><loc>'.gethttps($id).'</loc><priority>1.00</priority></url>';
        $maps.=gethttps($id)."\r\n";
    }
        $map.="</urlset>";
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/sitemap.xml",$map);
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/sitemap.txt",$maps);
        unset($map,$maps);
}


?>