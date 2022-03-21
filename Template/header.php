<?php
//禁用错误报告
error_reporting(0);
$runtimes=times13();
function times13(){
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($s1) + floatval($s2)) * 1000);
}
function fileline($path){
    $fp =fopen($_SERVER['DOCUMENT_ROOT'].$path ,'r');
        if($fp){
            $i=0;
            
            while(!feof($fp)){
                $str=fgets($fp,1024);
                $i++;
        }
    fclose($fp);
        }
        return $i;
}
function rline100($path){
    $fileline=fileline($path);
    $fileline=$fileline>100 ? $fileline-100 : 1;
    $fp =fopen($_SERVER['DOCUMENT_ROOT'].$path ,'r');
        if($fp){
            $i=0;
            $data=array(
                "data" => array(),
                "line" =>1
                );
            while(!feof($fp)){
                $str=fgets($fp,1024);
                
                    if($i >= $fileline){
                        array_push($data["data"],$str);
                    }
            $i++;
        }
        $data["line"] = $i;
        
    fclose($fp);//关闭文件
        }
        // print_r($data);
        return $data;
}
function rline($path,$minline=false,$maxlines=false){
    //获取文件行数或数据("$path",10,60)
    $fp =fopen($_SERVER['DOCUMENT_ROOT'].$path ,'r');
        if($fp){
            $i=0;
            $data=array(
                "data" => array(),
                "line" =>1
                );
            while(!feof($fp)){
                $str=fgets($fp,1024);
                if($minline and $maxlines){
                    if($i >= (int)$minline and $i <= (int)$maxlines){
                        array_push($data["data"],$str);
                    }
                }
            $i++;
        }
        $data["line"] = $i-2;
    fclose($fp);//关闭文件
        }
        // print_r($data);
        return $data;
}
// print_r( rline("/index.php") );exit;
// echo rline("/index.php",12,25)['line'] ;exit;
// file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
function time13(){
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($s1) + floatval($s2)) * 1000);
}
function webviews(){
    $views = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/views.php");
    $views++;
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/views.php",$views);
}
webviews();
$views = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Admin/Config/views.php");
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
function articlecount(){
    return count(rdata("/Admin/Config/indexes.php"));
}
function filetime($path){
    return date("Y-m-d H:i:s",filectime($_SERVER['DOCUMENT_ROOT'].$path));
}
// 获取网站基本参数
$config = rdata("/Admin/Config/config.php");
//end
function geturls(){
    if (@$_SERVER['HTTPS'] != "on") {
        return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }else{
        return "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta charset="utf-8" />
		<?php
		if(@strlen($_REQUEST['c'])>0){
		    echo '<title>'.$config['网站标题'].'-'.$_REQUEST['c'].'</title>';
		}else if(@strlen($_REQUEST['id'])==8){
		    $id=$_REQUEST['id'];
            $article=strlen($id)==8 ? rdata("/Admin/Config/indexes.php") : die("<h3 style='width:100vw;text-align:center;margin-top:80px;'>没有此文章</h3>");
            $article=$article[$id] ? $article[$id] : die("<h3 style='width:100vw;text-align:center;margin-top:80px;'>没有此文章</h3>");
            $category=$article['c'];
            $title=$article['t'];
            $article=rdata("/Article/".$id.".php");
            $data=$article['0'] ? $article['0'] : "文章数据丢失";
            $article=rdata("/Category/".$category.".php");
            $articles=$article[$id] ? $article[$id] : "文章数据丢失";
            if($articles!=="文章数据丢失"){
                $views=$article[$id]['v']+1;
                $article[$id]['v']=$views;
                wdata("/Category/".$category.".php",$article);
                unset($article);
                $keywords=$articles['k'];
                $titles=$articles['t'];
                $description=mb_substr(strip_tags($data),0,128,'utf-8');
            }
		    echo '<title>'.$title.'</title>';
            echo '<meta name="keywords" content="'.$keywords.'">';
            echo '<meta name="description" content="'.$description.'">';
		}else{
    		echo '<title>'.$config['网站标题'].'</title>';
            echo '<meta name="keywords" content="'.$config['关键词'].'">';
            echo '<meta name="description" content="'.$config['描述'].'">';
		}
        ?>
		<link href="/Style/style.css" rel="stylesheet">
		<style>
		    .navs ul li a,.nav ul li a,#list li,#list li h2 a,.links,.btn,.top,.links a,#bt a,.t2 p ,.t2 h2,#bt a,.t2 a,.footer,#runtimes,.nav,::-webkit-input-placeholder,#content,a{color:<?php echo $config['网站字体颜色']; ?>}

            .navs,.t2,.nav,#list li,#content{background-color:rgba(0,0,0,0.<?php echo $config['网站透明度'];?>);background-image: url(http://v.4asport.com:83/img/lbg.png);}
		</style>
    </head>
	<body style="background-color:<?php echo $config['网站背景色']; ?>;">
		<!--头部-->
		<div class="t1" align="center">
			<div class="t2">
				<a class="logo" href="/" style="font-size:58px">🧞️</a>
				<h2 style="margin-top: 10px;"><?php echo $config['网站标题']; ?></h2>
				<p style="margin-top: 10px;"><?php echo $config['网站简介']; ?></p><br />
				<div id="bt">
					<?php
					if(strstr(geturls(),"/Admin")){
					    echo '<a href="javascript:(0)" onclick="relogin()" >退出登陆</a>';
					}else{
					    echo '<a href="/Admin/" target="_blank" >后台管理</a>';
					}
					?>
					<a id="qq" href="javascript:alert('<?php echo $config['客服']; ?>');" rel="nofollow">联系作者</a>
				</div><br />
			</div>
		</div>