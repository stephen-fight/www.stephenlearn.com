<?php
define('WP_USE_THEMES', false);
require('./wp-load.php');
$postId = (int)$_GET['id'];

if(!$postId){
	header("HTTP/1.1 404 Not Found");  
	header("Status: 404 Not Found");  
	exit();
}

$datas = array();
$fileds = DLIP_DownLoadCommon::fields();
$mataPrefix = DLIP_DownLoadCommon::$mataPrefix;
foreach($fileds as $k=>$v){
	$filed = $mataPrefix.$k;
	$datas[$k] = get_post_meta( $postId, $filed, true );
}
$op_sets = get_option( DLIP_DownLoadCommon::$optionName );

do_action('dlip_down_page',$datas);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title><?php echo $datas['title'];?></title>
<style>
body{
    margin:0;
    padding:0;
    background-color:#262626;
    font-size:14px;
    font-family:"Lantinghei SC", "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif;
    color:#fff;
}
a{ text-decoration:none; color:#fff}
a:hover{ text-decoration:underline;}

.fl{float:left;}
.fr{float:right;}

.container{
    max-width:762px;
    background-color:#444;
    margin:10px auto;
}

.title-bar{
    line-height:48px;
    background-color:#666; /*标题栏背景色*/
    color:#fff;
    font-size:18px;
    padding:0 16px;
}
.dl{overflow:hidden; padding:5px 20px; margin:0; line-height:20px;}
.dl dt,
.dl dd{float:left; margin:0;}
.dl dt{color:#fff;}
.dl .psw{margin-left:10px;}
.dl a{color:#fff; }
.item-style{border-bottom:1px dashed #262626;}

.source-name{
    padding:15px 20px;
    overflow:hidden;
    font-size:14px;
    line-height:20px;
    color:#fff;
    font-weight:normal;
}
.source-name span{ display:inline-block;}
.source-name b{color:#fff; font-weight:normal; display:inline-block; }

.banner-box{
    padding:16px;
    overflow:hidden;
    text-align:center;	
}
.banner-box2{
	width:728px;
	height:90px;
}
.banner-box img{max-width:100%;}

.banner-box-sm{
    overflow:hidden;
    height:30px;
    line-height:30px;
    padding:0 20px 20px;
}

.banner-box-sm .adbox{float:left; width:600px; height:30px;}
.banner-box-sm a{text-decoration:underline;}

.box-comm{width:770px; margin:0 auto; overflow:hidden;}

.banner-box-left,.banner-box-right{
	float:left; text-align:right; 
	width:336px; height:280px;
}
.banner-box-right{
	float:right; text-align:left;
}
@media screen and (max-width: 640px) {
    .banner-box-left,
    .banner-box-right{float:none; width:100%; text-align:center;}
    .btn-dl{float:none; padding:10px 0; display:block;}
}
</style>

<style>
<?php echo $op_sets['css'];?>
</style>
<script>
<?php echo $op_sets['js'];?>
</script>
</head>
<body>
<div class="container">
    <div class="title-bar">下载信息</div>
    
    <h1 class="source-name item-style"><span>资源名称：</span><b><?php echo $datas['title'];?></b></h1>
    <div class="banner-box item-style">
        <div class="banner-box-left">
            <!--下载中转页方形广告 L-->
			<?php echo $op_sets['ads1'];?>
            <!--下载中转页方形广告 L-->
        </div>
        <div class="banner-box-right">
            <!--下载中转页方形广告 R-->
          	<?php echo $op_sets['ads2'];?>
            <!--下载中转页方形广告 R-->
        </div>
    </div>
     
    <dl class="dl item-style">
        <dt>来源链接：</dt>
        <dd>
        <a class="fr btn-dl" href="<?php echo get_permalink($postId);?>" target="_blank" rel="nofollow">
         <?php echo get_permalink($postId);?>
        </a>
        </dd>
    </dl>
    
    <dl class="dl item-style">
        <dt>下载说明：</dt>
        <dd>点击下方链接入口下载<?php echo $datas['pwd']?'（下载密码：'.$datas['pwd'].'）':'';?>，如资源失效请到文章留言板留言！</dd>
    </dl>
    <!--下载中转页长幅广告 S-->
    <div class="banner-box banner-box2">
      <?php echo $op_sets['ads3'];?>
    </div>
    <!--下载中转页长幅广告 S-->

    <!--文字广告 S-->
    <div class="banner-box-sm">
        <div class="adbox">
            <?php echo $op_sets['ads4'];?>
        </div>
        <a class="fr btn-dl" href="<?php echo $datas['url'];?>" target="_blank" rel="nofollow">
            &#9658; 点击下载
        </a>
    </div>
    <!--文字广告 E-->
    <?php echo $op_sets['relate'];?>
</div>


<?php echo $op_sets['stats'];?>
<div style="width:762px; margin:15px auto; color:#efefef; text-align:center; font-size:12px;">
    Copyright &copy; 2016 <a href="http://www.wbolt.com/" target="_blank">WBOLT</a> | Powered by <a href="https://wordpress.org/plugins/download-info-page/" target="_blank">Download Info Page</a>
</div>
</body>
</html>

