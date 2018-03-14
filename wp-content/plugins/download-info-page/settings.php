<style>
    .form-table th, .form-wrap label{font-size:12px;color:#333;}
    .form-table th{width:120px;}
    .locale-zh-cn p.description{font-size:12px;}
    .adside{display:block; width:350px; padding-top:30px; margin-left:20px;}
    .adside a{display:block; text-decoration:none; background-color:#ccc; margin:0 5px 10px 5px; text-align:center;color:#fff;}
    .adside .ad1,.adside .ad2{width:150px; line-height:150px; float:left;}
    .adside .ad4{width:260px; line-height:20px;}
    .adside .ad3{width:310px; line-height:60px; clear:both;}
    .admain{overflow:hidden; }
    .js .postbox .hndle{ cursor:default;}
</style>
<div class="wrap" id="poststuff">
    <h1>下载中转设置</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( $setting_field );
        ?>
        <!-- 基本设置 S-->
        <div class="postbox-container">
            <div class="postbox">
                <h3 class="hndle">
                    <span>基本设置</span>
                </h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th>
                                <label for="<?php echo $option_name;?>_domain">
                                    中转页面域名设置
                                </label>
                            </th>
                            <td>
                                <input type="text"
                                       id="<?php echo $option_name;?>_domain"
                                       name="<?php echo $option_name;?>[domain]"
                                       class="regular-text"
                                       value="<?php echo isset($op_sets['domain'])?$op_sets['domain']:'';?>" />
                                <p class="description">以http://开头，不填时默认为博客地址；若使用子域名或者其他的域名时，需将域名解析至与博客主机一致的IP地址。</p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th>
                              <label for="<?php echo $option_name;?>_need_member">
                                    启用会员下载
                              </label>
                            </th>
                            <td><input type="checkbox"  id="<?php echo $option_name;?>_need_member"
                                     <?php echo isset($op_sets['need_member']) && $op_sets['need_member']?' checked':'';?>  name="<?php echo $option_name;?>[need_member]" value="1">
                              
								
                                <p class="description">启用时，需要登录才能查看到下载地址。</p>
                          </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- 基本设置 E-->

        <!-- 广告位设置 S-->
        <div class="postbox-container">
            <div class="postbox">
                <h3 class="hndle">
                    <span>中转页广告设置</span>
                </h3>
                <div class="inner-sidebar adside">
                    <div class="meta-box-sortabless">
                        <a class="ad1" href="http://www.wbolt.com/demo/download-info-page/?ad=adl" target="_blank">中转广告1</a>
                        <a class="ad2" href="http://www.wbolt.com/demo/download-info-page/?ad=adr" target="_blank">中转广告2</a>
                        <a class="ad3" href="http://www.wbolt.com/demo/download-info-page/?ad=adw" target="_blank">中转广告3</a>
                        <a class="ad4" href="http://www.wbolt.com/demo/download-info-page/?ad=adt" target="_blank">中转广告4</a>
                    </div>
                </div>
                <div class="inside admain">
                    <table class="form-table">
                        <tr valign="top">
                            <th>
                                <label for="<?php echo $option_name;?>_ads1">
                                    中转页广告1
                                </label>
                            </th>
                            <td><textarea name="<?php echo $option_name;?>[ads1]" rows="5" cols="50" id="<?php echo $option_name;?>_ads1" class="large-text code"><?php echo isset($op_sets['ads1'])?$op_sets['ads1']:'';?></textarea>
                                <p class="description">图文广告为佳，默认尺寸为336*280px，即第一行左边广告位。<a href="http://www.wbolt.com/demo/download-info-page/?ad=adl" target="_blank" >查看演示</a></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th>
                                <label for="<?php echo $option_name;?>_ads2">
                                    中转页广告2
                                </label>
                            </th>
                            <td><textarea name="<?php echo $option_name;?>[ads2]" rows="5" cols="50" id="<?php echo $option_name;?>_ads2" class="large-text code"><?php echo isset($op_sets['ads2'])?$op_sets['ads2']:'';?></textarea>
                                <p class="description">图文广告为佳，默认尺寸为336*280px，即第一行右边广告位。<a href="http://www.wbolt.com/demo/download-info-page/?ad=adr" target="_blank" >查看演示</a></p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th>
                                <label for="<?php echo $option_name;?>_ads3">
                                    中转页广告3
                                </label>
                            </th>
                            <td><textarea name="<?php echo $option_name;?>[ads3]" rows="5" cols="50" id="<?php echo $option_name;?>_ads3" class="large-text code"><?php echo isset($op_sets['ads3'])?$op_sets['ads3']:'';?></textarea>
                                <p class="description">图文广告为佳，默认尺寸为728*90px，即第二行长条广告位。<a href="http://www.wbolt.com/demo/download-info-page/?ad=adw" target="_blank" >查看演示</a></p>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th>
                                <label for="<?php echo $option_name;?>_ads4">
                                    中转页广告4
                                </label>
                            </th>
                            <td><textarea name="<?php echo $option_name;?>[ads4]" rows="5" cols="50" id="<?php echo $option_name;?>_ads4" class="large-text code"><?php echo isset($op_sets['ads4'])?$op_sets['ads4']:'';?></textarea>
                                <p class="description">文字广告位，默认尺寸为468*18px，推荐位上方文字广告位。<a href="http://www.wbolt.com/demo/download-info-page/?ad=adt" target="_blank" >查看演示</a></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- 广告位设置 E-->

        <!-- 高级设置 S-->
        <div class="postbox-container">
            <div class="meta-box-sortables ui-sortable">
                <div class="postbox closed">
                    <button type="button" class="handlediv button-link" id="J_displayBtn" aria-expanded="false"><span class="screen-reader-text">Toggle panel: 高级设置</span><span class="toggle-indicator" aria-hidden="false"></span></button>
                    <h2 class="hndle">
                        <span>高级设置</span>
                    </h2>
                    <div class="inside">
                        <table class="form-table">
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_relate">
                                        中转页相关文章推荐代码
                                    </label>
                                </th>
                                <td><textarea name="<?php echo $option_name;?>[relate]" rows="5" cols="50" id="<?php echo $option_name;?>_relate" class="large-text code"><?php echo isset($op_sets['relate'])?$op_sets['relate']:'';?></textarea>
                                    <p class="description">此处可以插入百度推荐、无觅关联推荐代码。以百度推荐为例，窗口类型选择为嵌入式，样式为通用图片型，蓝色单排横板。尺寸为760*187px，图片1行5列，展示形式为换一换。同时建议设置高级样式，保证样式与下载页面样式一致。</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_stats">
                                        中转页数据统计代码
                                    </label>
                                </th>
                                <td><textarea name="<?php echo $option_name;?>[stats]" rows="5" cols="50" id="<?php echo $option_name;?>_stats" class="large-text code"><?php echo isset($op_sets['stats'])?$op_sets['stats']:'';?></textarea>
                                    <p class="description">此处可以插入Google Analytics，百度统计，CNZZ等第三方统计代码，建议最多只使用一个统计代码。</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_downcss">
                                        自定义文章页下载信息版块CSS样式
                                    </label>
                                </th>
                                <td>
                                    <textarea name="<?php echo $option_name;?>[downcss]" rows="5" cols="50" id="<?php echo $option_name;?>_downcss" class="large-text code"><?php echo isset($op_sets['downcss'])?$op_sets['downcss']:'';?></textarea>
                                    <p class="description">高级用户可以通过自行编写文章页面下载按钮及下载信息的CSS样式，以替换预设的CSS样式。</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_downtpl">
                                        自定义文章页下载信息版块html模板
                                    </label>
                                </th>
                                <td>
                                    <textarea name="<?php echo $option_name;?>[downtpl]" rows="5" cols="50" id="<?php echo $option_name;?>_downtpl" class="large-text code"><?php echo isset($op_sets['downtpl'])?$op_sets['downtpl']:'';?></textarea>
                                    <p class="description">高级用户可以通过编写或者修改的形式，替换现有的文章页面的下载信息区块的HTML结构。</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_usrdowntpl">
                                        自定义文章页下载信息版块启用会员下载时html模板
                                    </label>
                                </th>
                                <td>
                                    <textarea name="<?php echo $option_name;?>[usrdowntpl]" rows="5" cols="50" id="<?php echo $option_name;?>_usrdowntpl" class="large-text code"><?php echo isset($op_sets['usrdowntpl'])?$op_sets['usrdowntpl']:'';?></textarea>
                                    <p class="description">高级用户可以通过编写或者修改的形式，替换现有的文章页面的下载信息区块的HTML结构。</p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_css">
                                        自定义中转页CSS样式
                                    </label>
                                </th>
                                <td><textarea name="<?php echo $option_name;?>[css]" rows="5" cols="50" id="<?php echo $option_name;?>_css" class="large-text code"><?php echo isset($op_sets['css'])?$op_sets['css']:'';?></textarea>
                                    <p class="description">高级用户可以自主编写中转页面的CSS样式文件，替换现有的CSS样式。</p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th>
                                    <label for="<?php echo $option_name;?>_js">
                                        自定义中转页JS代码
                                    </label>
                                </th>
                                <td><textarea name="<?php echo $option_name;?>[js]" rows="5" cols="50" id="<?php echo $option_name;?>_js" class="large-text code"><?php echo isset($op_sets['js'])?$op_sets['js']:'';?></textarea>
                                    <p class="description">高级用户可以插入自定义的JS代码，以实现更多的功能。</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- 高级设置 E-->

        <div class="postbox-container">
            <p class="submit">
                <input type="submit"
                       name="Submit"
                       class="button-primary"
                       value="保存" />
            </p>
        </div>
    </form>
</div>

<script>
    jQuery(document).ready(function($){
        $('#J_displayBtn').click(function(){
            $(this).parent().toggleClass('closed');
        })
    });
</script>
