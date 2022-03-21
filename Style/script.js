function d_posts(url,data,id=false){
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', url, true); 
    httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    httpRequest.send(data);
    httpRequest.onreadystatechange = function () {
        if (httpRequest.status == 200) {
           if(httpRequest.responseText==1 && id==false){
               console.log("统计生效");
           }else{
            //   document.getElementById(id).innerHTML = httpRequest.responseText;
           }
        }
    };
}
var time1 = Date.parse(new Date());
localAddress.url=document.URL;
localAddress.ref=document.referrer;
localAddress.time=time1/1000;
// console.log(localAddress)
localAddress=Object.values(localAddress);
d_posts("/Admin/Config/post.php","t=userviews&data="+localAddress.join(','));

//动态调节导航栏宽度，保证不错位显示
var ularrs=document.getElementsByClassName("list");
var liarrs=ularrs[0].getElementsByTagName("li").length;
ularrs[0].style.width = liarrs*88 + "px";
//网站运行时间
function runtimes(){
var X=new Date("1/18/2019 1:18:58");
var Y=new Date();
var T=(Y.getTime()-X.getTime());
var M=86400000;
var a=T/M;var A=Math.floor(a);var b=(a-A)*24;var B=Math.floor(b);var c=(b-B)*60;var C=Math.floor((b-B)*60);var D=Math.floor((c-C)*60);
document.getElementById("runtimes").innerHTML="本站运行: "+A+"天"+B+"小时"+C+"分"+D+"秒";
}
var int=self.setInterval("runtimes()",1000);
//百度自动收录
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
//奇虎360自动收录
(function(){
var src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
document.onkeydown=function(){
    if (event.keyCode == 13){
        if(document.getElementById("search")){
            if(document.getElementById("search").value.length>0){
                window.location.href="/search.php?key="+document.getElementById("search").value;
            }
        }
    }
}
function relogin(){
    document.cookie="name=";
    document.cookie="oo=";
    location.reload();
}