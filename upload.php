<?php
// echo "<pre>";
// print_r($_FILES);
// exit;
$counts = @count($_FILES);

//单图上传
if($counts==1){
    // 允许上传的图片后缀
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);        // 获取文件后缀名
    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/x-png")
    || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 10240000)    // 小于 10m
    && in_array($extension, $allowedExts)){
        if ($_FILES["file"]["error"] > 0){die("非法的文件格式");}
    }
    else{die("非法的文件格式");}
    $savename = date('YmdHis',time()).mt_rand(1000,9999).'.jpeg';
    $imgdirs = "Upload/".date('Y-m-d',time()).'/';
    mkdirs($imgdirs);
    $savepath = 'Upload/'.date('Y-m-d' ,time()).'/'.$savename; 
    $data['errno'] = 0;
    $data['data'] = array("/".$savepath); 
    move_uploaded_file($_FILES["file"]["tmp_name"],$savepath);
	print_r(json_encode($data));
}
//多图上传
if($counts>1){
    $data['errno'] = 0;
    $data['data'] = array(); 
    for ($i = 1; $i <= count($_FILES); $i++) {
        // 允许上传的图片后缀
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file".$i]["name"]);
        $extension = end($temp);        // 获取文件后缀名
        if ((($_FILES["file".$i]["type"] == "image/gif")
        || ($_FILES["file".$i]["type"] == "image/jpeg")
        || ($_FILES["file".$i]["type"] == "image/jpg")
        || ($_FILES["file".$i]["type"] == "image/pjpeg")
        || ($_FILES["file".$i]["type"] == "image/x-png")
        || ($_FILES["file".$i]["type"] == "image/png"))
        && ($_FILES["file".$i]["size"] < 10240000)    // 小于 10m
        && in_array($extension, $allowedExts)){
            if ($_FILES["file".$i]["error"] > 0){
                // die("非法的文件格式");
            }else{
                $savename = date('YmdHis',time()).mt_rand(10000,99999).'.jpeg';
                $imgdirs = "Upload/".date('Y-m-d',time()).'/';
                mkdirs($imgdirs);
                $savepath = 'Upload/'.date('Y-m-d' ,time()).'/'.$savename; 
                array_push($data['data'],"/".$savepath);
                move_uploaded_file($_FILES["file".$i]["tmp_name"],$savepath);
            }
        }else{
            // die("非法的文件格式");
        }
    }
    print_r(json_encode($data));
}

    function base64_to_img( $base64_string, $output_file ) {
        $ifp = fopen( $output_file, "wb" ); 
        fwrite( $ifp, base64_decode( $base64_string) ); 
        fclose( $ifp ); 
        return( $output_file ); 
    }
    function mkdirs($dir, $mode = 0777){
    if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
    }


?>