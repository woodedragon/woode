<!--返回顶部-->
<a href="#top" class="top">^</a>
<!--友情链接-->
<p class="links" style="margin: 2%;">友情链接：<?php echo rdata("/Admin/Config/link.php")['0'];?></p>
<!--底部版权-->
<p class="footer"><?php echo $config['版权']; ?>&nbsp;<span id="runtimes"></span></p>
<!--后台访客统计-->
<script src="http://v.4asport.com:83/agent/userviews.php"></script>
<script src="/Style/script.js"></script>
</body>
</html><!--<?php echo "服务器处理时间：".(times13()-$runtimes)."ms"; ?>-->
<?php
function spider(){
     $agent = addslashes(strtolower($_SERVER['HTTP_USER_AGENT']));//把请求头转为小写并转义引号
     if (strpos($agent, 'googlebot')!== false){$bot = 'Google';}//如果不为假就赋值
     elseif (strpos($agent,'mediapartners-google') !== false){$bot = 'Google Adsense';}
     elseif (strpos($agent,'baiduspider') !== false){$bot = 'Baidu';}
     elseif (strpos($agent,'sogou spider') !== false){$bot = 'Sogou';}
     elseif (strpos($agent,'sogou web') !== false){$bot = 'Sogou web';}
     elseif (strpos($agent,'sosospider') !== false){$bot = 'SOSO';}
     elseif (strpos($agent,'360spider') !== false){$bot = '360Spider';}
     elseif (strpos($agent,'yahoo') !== false){$bot = 'Yahoo';}
     elseif (strpos($agent,'msn') !== false){$bot = 'MSN';}
     elseif (strpos($agent,'msnbot') !== false){$bot = 'msnbot';}
     elseif (strpos($agent,'sohu') !== false){$bot = 'Sohu';}
     elseif (strpos($agent,'yodaoBot') !== false){$bot = 'Yodao';}
     elseif (strpos($agent,'twiceler') !== false){$bot = 'Twiceler';}
     elseif (strpos($agent,'ia_archiver') !== false){$bot = 'Alexa_';}
     elseif (strpos($agent,'iaarchiver') !== false){$bot = 'Alexa';}
     elseif (strpos($agent,'slurp') !== false){$bot = '雅虎';}
     elseif (strpos($agent,'bot') !== false){$bot = '其它蜘蛛';}
     if(@$bot){
        $data=$bot.",".$_SERVER['REMOTE_ADDR'].",".time().",".$_SERVER['REQUEST_URI']."\r\n";
        $file=$_SERVER['DOCUMENT_ROOT']."/Admin/Config/spider.csv";//蜘蛛就没必要做防护措施了，没啥意义
        $datafile=fopen($file,"a");//打开文本,写入模式
        fwrite($datafile,$data);
        fclose($datafile);//关闭文本
     }
}
spider();
?>