<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- 最新资讯 -->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7b82b618fb6c6e60ad9f99440d0916cc&action=lists&catid=%24this-%3Esub_news_catid&order=id+desc&limit=20\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$this->sub_news_catid,'order'=>'id desc','limit'=>'20',));}?>
<?php var_dump($data);?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

<!-- 图片新闻 -->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2c15201b8da4dca33415e8fc95f4c37b&action=lists&catid=%24this-%3Esub_news_catid&thumb=1+order%3D&limit=20\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$this->sub_news_catid,'thumb'=>'1 order=','limit'=>'20',));}?>
<?php var_dump($data);?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>


<!-- 热文排行 -->
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d8ac7e4a8b922ea08bf59782e212b201&action=hits&catid=%24this-%3Esub_news_catid&limit=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$this->sub_news_catid,'limit'=>'20',));}?>
<?php var_dump($data);?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>