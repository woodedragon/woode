<?php
include('../Template/header.php');

if($_COOKIE["user"] and $_COOKIE["oo"]){
    if($_COOKIE["user"]==$config["管理账号"] and $_COOKIE["oo"]==$config["管理密码"]){}else{header("Location:/Admin/bn_login.php");}
}else{
    header("Location:/Admin/bn_login.php");
}
?>

		<!--导航列表-->
		<div class="nav">
			<ul class="list" style="border-radius: 10px;">
				<li onclick="addrg(0)">
					后台首页
				</li>
				<li onclick="addrg(1)">
					新增文章
				</li>
				<li onclick="addrg(2)">
					文章管理
				</li>
				<li onclick="addrg(3)">
					分类管理
				</li>
				<li onclick="addrg(4)">
					蜘蛛记录
				</li>
				<li onclick="addrg(5)">
					访客记录
				</li>
				<li onclick="addrg(6)">
					网站设置
				</li>

			</ul>
        </div>
<!--后台控制台-->
<div style="margin-top: 10px;width: 96%;border-radius: 10px;margin-left:2%;background-color:#f8f8f8;margin-bottom:50px;height:auto;">
<style>
.btn{
    background-color: #333;
    color: #f8f8f8;
}
a{color:#333}
input{padding-left:10px;}
</style>
<div style="width:98%;margin-top: 10px;margin-left:1%;padding-top:10px;">
<!--公告栏-->
<!--<marquee style="color: red;font-size: 16px; width: 100%; height: 30px;margin-top: 10px;">公告：如发现bug请联系作者QQ：657258535 官方交流群：6245222  演示后台仅供参观，自己添加的文章可以随意删除，请不要删除原始数据。</marquee>-->
<!--后台首页-->
<div id="cd0" style="text-align:center;margin-top: 10px;">
<table  class="pure-table">
<tr>
<td >域名：<?php echo $_SERVER['SERVER_NAME']; ?></td>
<td >环境：<?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
<td>版本：<?php echo phpversion(); ?></td>
<td >端口：<?php echo $_SERVER['REMOTE_PORT']."/".$_SERVER["SERVER_PORT"]; ?></td>
</tr>
<tr>
<td >文章：<?php echo articlecount(); ?></td>
<td >总浏览量：<?php echo $views; ?></td>
<td >蜘蛛：<?php echo rline("/Admin/Config/spider.csv")['line']; ?></td>
<td >IP：<?php echo $_SERVER["REMOTE_ADDR"]."/".$_SERVER['SERVER_ADDR']; ?></td>
</tr>
</table></div>
<!--新增文章-->
<div id="cd1" style="display:none;">
<input id="bts" type="text" name="bt" placeholder="&nbsp;&nbsp;标题" value="" style="width:50%;height:28px;border: 1px solid #CDCDC1;margin-top: 10px;">
<select id="fl" style='width:10%;height:28px;border: 1px solid #CDCDC1;margin-top: 10px;'>
<?php
for ($i = 0; $i < count($config['分类']); $i++) {
    
    echo "<option value='".$config['分类'][$i]."'>".$config['分类'][$i]."</option>";
    // <option selected="selected" value='1'>源码下载</option>
}
?>

</select>
    <div id="editor" style="margin-top:20px">
        <p><blockquote><b>博你BLOG</b> - 博你欢心。</blockquote></p>
    </div>

<input id="tag" type="text" name="tag" placeholder="&nbsp;&nbsp;标签，必填，英文逗号分割" value="" style="width:100%;height:28px;border: 1px solid #CDCDC1;margin-top: 20px;">

<div align="center" ><a onclick="addarticle()" class="btn" href="#" style="border:0;margin-top:20px" class="btn">发布文章</a></div>
</div>



<script src="https://cdn.jsdelivr.net/npm/wangeditor@4.7.5/dist/wangEditor.min.js"></script>


<!--文章管理-->
<div id="cd2" style="display:none;">
<table  class="pure-table" >
<thead>
<tr>
<th >分类</th>
<th >标题</th>
<th >时间</th>
<th >编辑</th>
</tr>
</thead>
</table>
<table id="article" class="pure-table"></table></div>
<!--分类管理-->
<div id="cd3" style="display:none;">
    <div style="width:38px;height:38px;background-color:#333;margin:20px;text-align:center;line-height:33px;border-radius:50%;font-size:28px;color:#f8f8f8;border:0;margin-left:0px" onclick="add_up_del_category('0',1)">+</div>
    
<table  class="pure-table" >
    
<thead>
<tr>
<th >分类名</th>
<th >编辑</th>
</tr>
</thead>
<?php
for ($i=0; $i<count($config['分类']); $i++){
	    echo "<tr><td > ".$config['分类'][$i]."</td><td style='text-align:center;'><a class='btn' href='javascript:(0);' onclick=\"add_up_del_category('".$config['分类'][$i]."',2)\">编辑</a>&nbsp;&nbsp;<a class='btn' href='javascript:(0);' onclick=\"add_up_del_category('".$config['分类'][$i]."',3)\">删除</a></td></tr>";
		 }
?>
</table></div>
<!--蜘蛛记录-->
<div id="cd4" style="display:none;">
    <div style="width:38px;height:38px;background-color:#333;margin:20px;text-align:center;line-height:38px;border-radius:50%;font-size:12px;color:#f8f8f8;border:0;margin-left:0px" onclick="downspider()">下载</div>
    <div style="width:38px;height:38px;background-color:#333;margin:20px;text-align:center;line-height:38px;border-radius:50%;font-size:12px;color:#f8f8f8;border:0;margin-left:50px;margin-top:-57px" onclick="delspider()">清空</div>

<table  class="pure-table">
<thead>
<tr>
<th >序列</th>
<th >蜘蛛</th>
<th >IP</th>
<th >时间</th>
<th >抓取URL</th>
</tr>
</thead>
<?php
$arr = rline100("/Admin/Config/spider.csv");
$arr['data']=array_reverse($arr['data']);
$line=(int)$arr['line']>100 ? 99 : (int)$arr['line']-1;
// print_r($arr['data']);die;
$str = "";
for ($i=1; $i<$line; $i++){
    $spider = explode(",",$arr['data'][$i]);
    $str.= "<tr><td >".$i."</td> ".
    "<td >".$spider['0']."</td> ".
    "<td >".$spider['1']."</td> ".
    "<td >".date("Y/m/d H:i",$spider['2'])."</td> ".
    "<td >".$spider['3']."</td> ";
	}
	echo $str;
?>
</table>
<table id="spider" class="pure-table"></table></div>
<!--访客记录-->
<div id="cd5" style="display:none;">
    <div style="width:38px;height:38px;background-color:#333;margin:20px;text-align:center;line-height:38px;border-radius:50%;font-size:12px;color:#f8f8f8;border:0;margin-left:0px" onclick="downuserviews()">下载</div>
    <div style="width:38px;height:38px;background-color:#333;margin:20px;text-align:center;line-height:38px;border-radius:50%;font-size:12px;color:#f8f8f8;border:0;margin-left:50px;margin-top:-57px" onclick="deluserviews()">清空</div>
<table class="pure-table">
<thead>
<tr>
<th >序列</th>
<th >客户端</th>
<th >浏览器</th>
<th >IP</th>
<th >地区</th>
<th >运营商</th>
<th >访问页</th>
<th >来源</th>
<th >时间</th>
</tr>
</thead>
<?php
$arr = rline100("/Admin/Config/userviews.csv");
// print_r($arr);die;
$arr['data']=array_reverse($arr['data']);
$line=(int)$arr['line']>100 ? 99 : (int)$arr['line']-1;
$str = "";
for ($i=1; $i<$line; $i++){
    $spider = explode(",",$arr['data'][$i]);
    $str.= "<tr><td >".$i."</td> ".
    "<td >".$spider['0']."</td> ".
    "<td >".$spider['1']."</td> ".
    "<td >".$spider['2']."</td> ".
    "<td >".$spider['3']."</td> ".
    "<td >".$spider['4']."</td> ".
    "<td ><a href='".$spider['5']."' title='".$spider['5']."' target='_blank' >点击查看</a></td> ".
    "<td ><a href='".$spider['6']."' title='".$spider['6']."' target='_blank' >点击查看</a></td> ".
    "<td >".date("Y/m/d H:i",$spider['7'])."</td> ";
	}
	echo $str;
?>
</table>
<table id="userviews" class="pure-table"></table></div>
<!--网站配置-->
<div id="cd6" style="display:none;">
    <p id="titles" class="titles">网站配置</p>
    <div id="biaodan" style="width: 100%;">
        <p class="hrssssss"></p>
		<input type="text" value="<?php echo $config['网站标题']; ?>" id="cd5s1" class="biaodantext" /><input type="button" value="网站标题(根据SEO建议不要超过28个字符)" class="biaodanstr" />
		<p class="hrssssss"></p>
		<input type="text" value="<?php echo $config['关键词']; ?>" id="cd5s2" class="biaodantext" /><input type="button" value="网站关键词(用英文,隔开,不要超过8个词汇)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['描述']; ?>" id="cd5s3" class="biaodantext" /><input type="button" value="网站描述(描述网站特色，不要超过120个字符)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['客服']; ?>" id="cd5s4" class="biaodantext" /><input type="button" value="网站客服" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['版权']; ?>" id="cd5s5" class="biaodantext" /><input type="button" value="网站版权" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['网站简介']; ?>" id="cd5s6" class="biaodantext" /><input type="button" value="网站简介(介绍网站定位,不要超过120个字符)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		
		<input type="text" value="<?php echo $config['网站背景色']; ?>" id="cd5s7" class="biaodantext" /><input type="button" value="网站背景色(默认：#00C5CD)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['网站透明度']; ?>" id="cd5s8" class="biaodantext" /><input type="button" value="网站透明度(默认：2 范围1-9)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['网站字体颜色']; ?>" id="cd5s9" class="biaodantext" /><input type="button" value="网站字体颜色(默认：#F8F8F8)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['关闭站点']; ?>" id="cd5s10" class="biaodantext" /><input type="button" value="关闭站点 默认为：false （注：正常访问false  关站true)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="<?php echo $config['管理账号']; ?>" id="cd5s11" class="biaodantext" /><input type="button" value="管理员账号" class="biaodanstr" />
		<p class="hrssssss"></p> 
		<input type="text" value="" id="cd5s12" class="biaodantext" /><input type="button" value="管理员密码重置(保持为空则不修改,必须大于等于6位数)" class="biaodanstr" />
		<p class="hrssssss"></p> 
		
		<a class="btn" onclick="postcd5data()" style="">提交</a>
		<p id="titles" class="titles" style="margin-top:50px;margin-bottom:20px;">友情链接</p>
		<textarea id="link" style="width:80%;height:88px;"><?php echo rdata("/Admin/Config/link.php")['0'];?></textarea><br />
		<a class="btn" onclick="link()" style="">提交</a>

</div>
    
</div>
<!--end-->
</div>
<br /><br /></div>
<iframe id="ifm" src="" style="width:1px;height:1px;"></iframe>
<script>

function d_post(url,data,id=false){
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', url, true); 
    httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpRequest.send(data);
    httpRequest.onreadystatechange = function () {
        if (httpRequest.status == 200) {
           if(httpRequest.responseText==1 && id==false){
               alert("成功");
           }else{
               document.getElementById(id).innerHTML = httpRequest.responseText;
           }
        }
    };
}

//蜘蛛记录
function downspider(){
    document.getElementById("ifm").src="/Admin/Config/spider.csv";
}
//清空蜘蛛记录
function delspider(){
    d_post("/Admin/Config/post.php","t=delspider");
}
//访问记录
function downuserviews(){
    document.getElementById("ifm").src="/Admin/Config/userviews.csv";
}
//清空访问记录
function deluserviews(){
    d_post("/Admin/Config/post.php","t=deluserviews");
}
//后台获取文章列表
function rarticle(){
    d_post("/Admin/Config/post.php","t=Article&p=1","article");
}
rarticle();
//请求分页数据
function page(page){
    d_post("/Admin/Config/post.php","t=Article&p="+page,"article");
}

//默认点亮第一个导航
let ularr=document.getElementsByClassName("list");
let liarr=ularr[0].getElementsByTagName("li");
liarr[0].classList.add("avr");
//控制显示局部区域
function addrg(id){
    for(var i=0 ; i<=liarr.length-1 ; i++){
    	liarr[i].classList.remove("avr");
    	document.getElementById("cd"+i).style.display="none";
    }
    liarr[id].classList.add("avr");
    document.getElementById("cd"+id).style.display="block";
}
<?php
if(@$_REQUEST['nid']){echo "addrg(".$_REQUEST['nid'].")";}
?>
//获取参数快捷方式
function getv(id){
    return document.getElementById(id).value;
}
function rgetv(id,data){
        document.getElementById(id).value=data;
}
var E = window.wangEditor;
const editor = new E('#editor');
// var editor2 = new E('#editor2');
// editor2.create();
// 或者 var editor = new E( document.getElementById('editor') )
// 	editor.customConfig.uploadImgShowBase64 = false;   // 使用 base64 保存图片
editor.config.pasteFilterStyle = false;// 关闭粘贴样式的过滤
editor.config.pasteIgnoreImg = false;//忽略粘贴内容中的图片
editor.config.uploadImgServer = '/upload.php';//上传图片接口
editor.config.uploadImgMaxSize = 10 * 1024 * 1024; // 上传图片大小限制5M
editor.config.uploadImgMaxLength = 10 // 一次最多上传 100 个图片
editor.config.uploadImgTimeout = 60 * 1000;//上传接口等待的最大时间
editor.config.showLinkImgAlt = true;// 配置alt选项
editor.config.showLinkImgHref = true;// 配置超链接
editor.config.uploadImgAccept = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
editor.config.uploadFileName = 'file';
editor.config.uploadImgHooks = {
            before: function (xhr) {
                // console.log(xhr)
                // return {
                //     prevent: true,
                //     msg: '阻拦 xhr 发送'
                // }
            },
            success: function (xhr) {
                // console.log('success', xhr)
            },
            fail: function (xhr, editor, resData) {
                alert("插入图片失败")
            },
            error: function (xhr, editor, resData) {
                alert("插入图片出错")
            },
            timeout: function (xhr) {
                alert("插入图片超时")
            },
            customInsert: function (insertImgFn, result) {
                // console.log('customInsert', result)
                for(var i=0;i<result.data.length;i++){
                insertImgFn(result.data[i]); // 只插入一个图片，多了忽略
                }
            }
        }
        
editor.create();

function addarticle(){
    var bts=document.getElementById("bts").value;//titles
    var myselect=document.getElementById("fl");
    var index=myselect.selectedIndex;
    var category=myselect.options[index].value;//category
    var nr=editor.txt.html();//body
    var tag = document.getElementById("tag").value;//tag
    d_post("/Admin/Config/post.php","t=addArticle&c="+category+"&title="+bts+"&k="+tag+"&b="+nr);
    document.getElementById("bts").value="";
    document.getElementById("tag").value="";
    editor.txt.html("");
}

function upArticle(id){
    ///Admin/Config/post.php?t=rArticle&id=
    // a_post("/Admin/Config/post.php","t=rArticle&id="+id);
    window.location.href="/Admin/edit.php?aid="+id;
}
function delArticle(id){
    d_post("/Admin/Config/post.php","t=delArticle&id="+id);
    setTimeout(function(){top.location="/Admin/index.php?nid=2";}, 1500);
}

function add_up_del_category(str,state){
    if(state!==3){
        var person=prompt("请输入分类名","");
        if (person==null || person==""){
            return;
        }
    }
    if(state==1){
        d_post("/Admin/Config/post.php","t=addCategory&cname="+person) ; 
    }else if(state==2){
        d_post("/Admin/Config/post.php","t=upCategory&cname="+str+"&newcname="+person) ;
    }else if(state==3){
        if(confirm("真的要删除整个分类和文章吗?，整个过程是不可逆的")){
                alert("现在强制关闭网页或浏览器即可反悔，确定删除？");
           }
           else{
            return
           }
        d_post("/Admin/Config/post.php","t=delCategory&cname="+str) ;
    }
    setTimeout(function(){top.location="/Admin/index.php?nid=3";}, 1500);
}

//获取网站配置的参数
function postcd5data(){
    var str = "";
    for(var i=1; i<=12;i++){
        if(i==1){
            str+="cd5s"+i+"="+getv("cd5s"+i); 
        }else{
            str+="&cd5s"+i+"="+getv("cd5s"+i); 
        }
    }
    d_post("/Admin/Config/post.php","t=Webconfig&"+str);
}

function link(){
    var data=document.getElementById("link").value;
    // console.log(data)
    d_post("/Admin/Config/post.php","t=link&data="+data);
}



</script>
<?php
include('../Template/footer.php');
?>