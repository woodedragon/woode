<?php
include('../Template/header.php');

if($_COOKIE["user"] and $_COOKIE["oo"]){
    if($_COOKIE["user"]==$config["管理账号"] and $_COOKIE["oo"]==$config["管理密码"]){}else{header("Location:/Admin/bn_login.php");}
}else{
    header("Location:/Admin/bn_login.php");
}
//读取文章数据

    if( strlen($_REQUEST['aid'])==8 ){
        $id=$_REQUEST['aid'];
        $indexes = rdata("/Admin/Config/indexes.php");//读取索引数据
        $data=array();
        if($indexes[$id]){
            $data['c']=$indexes[$id]['c'];
            $data['t']=$indexes[$id]['t'];
            unset($indexes);//清理内存
            $article = rdata("/Category/".$data['c'].".php");//读取文章数据
            $data['k']=$article[$id]['k'];
            unset($article);//清理内存
            $data['b']=rdata("/Article/".$id.".php")['0'];//写入文章索引
            // echo "<pre.";print_r($data); die;
        }
    }else{die("参数错误");}

?>
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

<!--新增文章-->
<div id="cd1" style="">
<input id="bts" type="text" name="bt" placeholder="&nbsp;&nbsp;标题" value="<?php echo $data['t'];?>" style="width:50%;height:28px;border: 1px solid #CDCDC1;margin-top: 10px;">
<select id="fl" style='width:10%;height:28px;border: 1px solid #CDCDC1;margin-top: 10px;'>
<?php
for ($i = 0; $i < count($config['分类']); $i++) {
    if($data['c']==$config['分类'][$i]){
        echo '<option selected="selected" value="'.$config['分类'][$i].'">'.$config['分类'][$i].'</option>';
    }else{
        echo "<option value='".$config['分类'][$i]."'>".$config['分类'][$i]."</option>";
    }
}
?>

</select>
    <div id="editor" style="margin-top:20px">
        <?php echo $data['b'];?>
    </div>

<input id="tag" type="text" name="tag" placeholder="&nbsp;&nbsp;标签，必填，英文逗号分割" value="<?php echo $data['k'];?>" style="width:100%;height:28px;border: 1px solid #CDCDC1;margin-top: 20px;">

<div align="center" ><a onclick="uparticle()" class="btn" href="#" style="border:0;margin-top:20px" class="btn">更新文章</a></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/wangeditor@4.7.5/dist/wangEditor.min.js"></script>
<!--end-->
</div>
<br /><br /></div>
<script>
//获取参数快捷方式
function getv(id){
    return document.getElementById(id).value;
}
function rgetv(id,data){
        document.getElementById(id).value=data;
}

function a_post(url,data){
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', url, true); 
    httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpRequest.send(data);
    httpRequest.onreadystatechange = function () {
        if (httpRequest.status == 200) {
           if(httpRequest.responseText==1){
            //   var data =JSON.parse(httpRequest.responseText);
              location.href="/Admin/?nid=2";
           }
        }
    };
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

function uparticle(){
    var myselect=document.getElementById("fl");
    var index=myselect.selectedIndex;
    var category=myselect.options[index].value;//category
    var nr=editor.txt.html();//body
    var data = "t=upArticle&title="+getv("bts")+"&c="+category+"&k="+getv("tag")+"&id=<?php echo $id; ?>&b="+nr;
    // console.log(data)
    a_post("/Admin/Config/post.php",data);
}

</script>
<?php
// include('../Template/footer.php');
?>