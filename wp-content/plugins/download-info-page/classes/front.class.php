<?php


class DLIP_DownLoadFront{	
	
	public function __construct(){	
		
		$this->init();
	}
	public function init(){
		add_filter('the_content',array($this,'the_content'));
		add_action('wp_footer', array($this,'downStyle'));
		
		add_action('dlip_down_page',array($this,'down'));
	}
	function tourl(){
		global $postId;
		if($postId){
			$url = get_permalink($postId);
		}else{
			$url = get_option('siteurl');
		}
		wp_redirect($url);
	}
	public function down($data){
		global $current_user, $display_name , $user_email;
		$op_sets = get_option( DLIP_DownLoadCommon::$optionName );
		if(isset($op_sets['need_member']) && $op_sets['need_member']){
			$user_id = $current_user->ID;
			if(!$user_id)$this->tourl();		
		}
	}
	public function the_content($content){
	  if(is_single()) {     
		$content .= $this->downHtml();
	  }
	  return $content;
	}
	
	private function downHtml(){
		
		global $current_user;
		
		//配置
		$op_sets = get_option( DLIP_DownLoadCommon::$optionName );
		$tpl = $this->defaultTpl();
		if(isset($op_sets['downtpl']) && $op_sets['downtpl']){
			$tpl = $op_sets['downtpl'];
		}
		if(isset($op_sets['need_member']) && $op_sets['need_member']){
			if(!$current_user || !$current_user->ID){
				$tpl = isset($op_sets['usrdowntpl']) && $op_sets['usrdowntpl'] ?$op_sets['usrdowntpl'] : $this->defaultUsrTpl();
			}
		}
		$tpl = apply_filters('dlip_down_tpl',$tpl);
		$datas = $this->metadata(true);
		
		
		return $this->parseTpl($tpl,$datas);
		
	}
	
	public function metadata($isDown = false){
		$postId = get_the_ID();		
		//字段
		$fields = DLIP_DownLoadCommon::fields();
		$prefix = DLIP_DownLoadCommon::$mataPrefix;
		//字段值
		$datas = array();		
		if(is_array($fields))foreach($fields as $k=>$v){
			$field = $prefix.$k;
			$datas[$k] = get_post_meta( $postId,$field , true );
		}
		if(isset($datas['url']))$datas['org_url'] = $datas['url'];
		if($isDown && $datas['url']){
			//配置
			$op_sets = get_option( DLIP_DownLoadCommon::$optionName );
			if($op_sets['domain']){
				$datas['url'] = $op_sets['domain'].'/down.php?id='.$postId;
			}else if($siteurl = get_option('siteurl')){
				$datas['url'] = $siteurl.'/down.php?id='.$postId;
			}
		}
		return $datas;
	}
	
	

	private function parseTpl($tpl,$datas){
		if(!$tpl)return '';
		if(!$datas['url'])return '';
		if(is_array($datas))foreach($datas as $k=>$v){
			if(!$v){
				$tpl = preg_replace('#{if '.$k.'}.+?{/if}#s','',$tpl);
				continue;
			}
			//preg_match('#{if '.$k.'}(.+?){/if}#s',$tpl,$m);		
			$tpl = preg_replace('#{if '.$k.'}(.+?){/if}#s','$1',$tpl);
			$tpl = str_replace('{'.$k.'}',$v,$tpl);
		}
		return $tpl;
	}
	private function defaultUsrTpl(){
		$reg = get_option('siteurl').'/wp-login.php?action=register';
		$login = get_option('siteurl').'/wp-login.php';
		$tpl = '<style>.wbolt-btn, a.wbolt-btn{min-width:58px;}a.wbolt-btn.wbolt-btn-outline{ border:1px solid #cecece;background-color:#fff;color:#3a4258 !important}</style>
<div class="wbolt-box">
    <h3 class="wb-title">下载信息</h3>
    <div class="txtc">
        <p>-------［<span class="hl">下载</span>需要登录］-------</p>
        <a class="wbolt-btn wbolt-btn-outline" href="'.$login.'">登录</a>
        <a class="wbolt-btn" href="'.$reg.'">免费注册</a>
    </div>
</div>';
		
		return $tpl;
	}
	private function defaultTpl(){

		$tpl = '<div class="download-info">
		<h3>下载信息</h3>
		<ul>
		{if title}<li>名称：<b>{title}</b></li>{/if}
		{if format}<li>格式：<b>{format}</b></li>{/if}
		{if version}<li>版本：<b>{version}</b></li>{/if}
		{if size}<li>大小：<b>{size}</b></li>{/if}
		</ul>
		{if url}<p><a class="btn-download" href="{url}" target="_blank" rel="nofollow"><i class="icon-download"></i> <span>点击下载</span></a></p>{/if}
		</div>';
		
		return $tpl;
	}
	
	//内容下载样式
	function downStyle(){	
	?>
	<style>	
	a.btn-download{
		display:inline-block;
		*display:inline;
		*zoom:1;
		min-width:100px;
		line-height:16px;
		background-color:#79b1ef !important; /*按钮默认底色*/
		padding:8px 10px;
		text-align:center;
		color:#fff !important; /*按钮默认字体颜色*/
		font-size:12px;
		border-radius:4px;
		margin:15px 0 0 16px;
		text-decoration:none;
	}
	a.btn-download:hover{
		background-color:#6598d0 !important; /*按钮鼠标经过底色*/
	}
	
	a.btn-download span{
		display:block;
	}
	
	a.btn-download .icon-download{
		display:inline-block;
		*display:inline;
		*zoom:1;
		width:28px;
		height:28px;
		background:url(<?php echo plugins_url("images/icon-download-sm.png", DLIPP_BASE_FILE)?>) no-repeat; /*旧版浏览器图标*/
	}
	:root a.btn-download .icon-download{
		background:url(<?php echo plugins_url("images/icon-download.png", DLIPP_BASE_FILE)?>) no-repeat; /*现代浏览器图标*/
		background-size:28px 28px;
	}
	</style>
	<?php
	}

}