<?php


class DLIP_DownLoadAdmin{
	
	
	public function __construct(){	
		
		$this->init();
	}
	public function init(){
		if(is_admin()){
			register_activation_hook(DLIPP_BASE_FILE, array($this,'plugin_activate'));	
			register_deactivation_hook(DLIPP_BASE_FILE, array($this,'plugin_deactivate'));
			
			
			add_action( 'admin_menu', array($this,'admin_menu') );
			add_action( 'admin_init', array($this,'admin_init') );
			
			add_filter( 'plugin_action_links', array($this,'actionLinks'), 10, 2 );

			add_action( 'add_meta_boxes', array($this,'addMataBox') );
	 
			//向后兼容（WP3.0前）
			//add_action( 'admin_init', array($this,'addMataBox'), 1 );
			
			
			/* 写入数据*/
			add_action( 'save_post', array($this,'saveMatadata') );
		}
		
		
	}
	
	function actionLinks( $links, $file ) {
		
		if ( $file != plugin_basename(DLIPP_BASE_FILE) )
			return $links;
	
		$settings_link = '<a href="'.menu_page_url( DLIP_DownLoadCommon::$name, false ).'">设置</a>';
	
		array_unshift( $links, $settings_link );
	
		return $links;
	}
	
	function admin_menu(){
		add_options_page(
					'Download Info Page 设置',
					'DIP设置',
					'manage_options',
					DLIP_DownLoadCommon::$name,
					array($this,'admin_settings')
				);
	}
	function admin_settings(){
		$setting_field = DLIP_DownLoadCommon::$settingField;
		$option_name = DLIP_DownLoadCommon::$optionName;
		$op_sets = get_option( $option_name );
		
		include_once( DLIPP_PATH.'/settings.php' );
	}

	function admin_init(){
		register_setting(  DLIP_DownLoadCommon::$settingField,DLIP_DownLoadCommon::$optionName );
	}
	/*在文章和页面编辑界面的主栏中添加一个模块 */
	function addMataBox() {
		$screens = array( 'post');//, 'page' 
		foreach ($screens as $screen) {
			add_meta_box(
				DLIP_DownLoadCommon::$name.'_sectionid',
				'文件下载',
				array($this,'mataBoxForm'),
				$screen
			);
		}
	}
	
	

 
	/* 输出模块内容 */
	function mataBoxForm( $post ) {
	 
	  // 使用随机数进行核查
	  wp_nonce_field( plugin_basename( DLIPP_BASE_FILE ), DLIP_DownLoadCommon::$name.'_plugin_noncename' );
	 
	  // 用于数据输入的实际字段
	  // 使用 get_post_meta 从数据库中检索现有的值，并应用到表单中
	  $fields = DLIP_DownLoadCommon::fields();
	  $mataPrefix = DLIP_DownLoadCommon::$mataPrefix;
	  $style = '<style>
					.dip-post-sitting-item{padding-bottom:5px;}
					#_mddp_down_title{width:500px;}
					#_mddp_down_url{width:500px;}
				</style>';
	  $html =$style . '<div class="dip-post-sitting-panel">';
	  foreach($fields as $key=>$val){
		  $keyfield = $mataPrefix.$key;		  
		  $value = get_post_meta( $post->ID, $keyfield, true );		  
		  $val['name'] = $keyfield;
		  $val['value'] = $value;
		  $html .= $this->inputRender($val);
	  }
	  $html .= '</div>';
	  echo $html;
	}
	function fieldName($name){
		
	}
	
	function renderText($opt){
		$html = '<label for="'.$opt['name'].'">'.$opt['text'].' <input type="'.$opt['type'].'"';
		if(isset($opt['name'])){
			$html .= ' name="'.$opt['name'].'"';
		}
		if(isset($opt['id'])){
			$html .= ' id="'.$opt['id'].'"';
		}else if(isset($opt['name'])){
			$html .= ' id="'.$opt['name'].'"';
		}
		if(isset($opt['value'])){
			$html .= ' value="'.esc_attr($opt['value']).'"';
		}
		if(isset($opt['attr'])){
			$html .= ' '.$opt['attr'];
		}		
		if(isset($opt['style'])){
			$html .= ' '.$opt['style'];
		}
		$html .= ' /></label>';
		return $html;
	}
	function renderChkBox($opt){
		$html = $opt['text'];
		$emptylen = !isset($opt['value']) || strlen($opt['value']) == 0;
		$emptylen = $opt['type'] == 'radio'  && $emptylen;
		if(is_array($opt['prop']))foreach($opt['prop'] as $k=>$v){
			if($emptylen){
				$opt['value'] = $k;
				$emptylen = false;
			}
			$html .= ' <label for="'.(isset($opt['id'])?$opt['id']:$opt['name']).'_'.$k.'"><input type="'.$opt['type'].'"';
			if(isset($opt['name'])){
				$html .= ' name="'.$opt['name'].'"';
			}
			if(isset($opt['id'])){
				$html .= ' id="'.$opt['id'].'_'.$k.'"';
			}else if(isset($opt['name'])){
				$html .= ' id="'.$opt['name'].'_'.$k.'"';
			}
			$html .= ' value="'.esc_attr($k).'"';
			if(isset($opt['value']) && strlen($opt['value'])>0 && $opt['value'] == $k){
				$html .= ' checked';
			}
			if(isset($opt['attr'])){
				$html .= ' '.$opt['attr'];
			}		
			if(isset($opt['style'])){
				$html .= ' '.$opt['style'];
			}
			$html .= ' /> '.$v.' </label>';
			
		}
		return $html;
	}
	function inputRender($setting){
		$keyfield = $setting['name'];

		$html = '<div class="dip-post-sitting-item">';
		switch($setting['type']){
			case 'checkbox':
			case 'radio':
				$html .= $this->renderChkBox($setting);
			break;
			default:
				$html .= $this->renderText($setting);
			break;
		}
		$html .=  '</div>';		
		$action = 'dlip_render_mata_field_'.$setting['type'];		
		$html = apply_filters($action,$html,$setting);		
		return $html;
	}
 
	/* 文章保存时，保存我们的自定义数据*/
	function saveMatadata( $post_id ) {
	 
	  // 首先，我们需要检查当前用户是否被授权做这个动作。 
	  if (isset($_POST['post_type']) &&  'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return;
	  } else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;
	  }
	 
	  // 其次，我们需要检查，是否用户想改变这个值。
	  $noncename = DLIP_DownLoadCommon::$name.'_plugin_noncename';
	  if ( ! isset( $_POST[$noncename] ) || ! wp_verify_nonce( $_POST[$noncename], plugin_basename( DLIPP_BASE_FILE ) ) )
		  return;
	 
	  // 第三，我们可以保存值到数据库中
	 
	  //如果保存在自定义的表，获取文章ID
	  $post_ID = $_POST['post_ID'];
	  
	  $fields = DLIP_DownLoadCommon::fields();
	  $mataPrefix = DLIP_DownLoadCommon::$mataPrefix;
	  $params = array();

	  foreach($fields as $key=>$val){
		  $field = $mataPrefix.$key;
		  $params[$key] = $_POST[$field];
		  //过滤用户输入
		  $mydata = sanitize_text_field( $_POST[$field] ); 
		  // 使用$mydata做些什么 
		  // 或者使用
		  add_post_meta($post_ID, $field, $mydata, true) or
		  update_post_meta($post_ID, $field, $mydata);
		  // 或自定义表（见下面的进一步阅读的部分）
	  }
	  
	}
	


	function plugin_activate(){
		$file = ABSPATH.'down.php';
		if(!file_exists($file)){
			copy(DLIPP_PATH.'/down.php',ABSPATH.'/down.php');
		}
	}
	
	function plugin_deactivate()
	{
		$file = ABSPATH.'down.php';
		if(file_exists($file)){
			unlink($file);
		}
	}
	
}
