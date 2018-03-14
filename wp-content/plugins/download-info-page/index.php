<?php
/*
Plugin Name: Download Info Page
Plugin URI: http://www.wbolt.com/
Description: Download Info Pages 是一款适用于资源下载类博客的 WordPress 插件。支持站长发布资源时，自动为资源生成中转页面，然后在中转页面投放网站联盟广告获得收益.. 
Author: wbolt
Version: 0.2.1
Author URI:http://www.wbolt.com/
*/
define('DLIPP_PATH',dirname(__FILE__));
define('DLIPP_BASE_FILE',__FILE__);

require_once DLIPP_PATH.'/classes/common.class.php';
require_once DLIPP_PATH.'/classes/admin.class.php';
require_once DLIPP_PATH.'/classes/front.class.php';

new DLIP_DownLoadAdmin();

new DLIP_DownLoadFront();
