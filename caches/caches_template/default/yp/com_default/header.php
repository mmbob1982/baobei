<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo $SEO['title'];?></title>
<meta content="<?php echo $SEO['keywords'];?>" name="keywords" />
<meta content="<?php echo $SEO['description'];?>" name="description" />
<link href="<?php echo CSS_PATH;?>reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_PATH;?>style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.sgallery.js"></script>
</head>
<body>
<div class="body-top">
    <div class="content">
    		<div class="lf"><a href="<?php echo siteurl($siteid);?>" target="_blank">首页</a><span> | </span><a href="<?php echo get_yp_url();?>" target="_blank">企业黄页</a><span> | </span><a href="<?php echo get_yp_url('company');?>" target="_blank">企业库</a>
			<?php $n=1;if(is_array($this->models)) foreach($this->models AS $r) { ?>
			 <?php $r['setting'] = string2array($r['setting']);?>
			 <?php if($r['setting']['ismenu']) { ?>
				<span> | </span>
				<a href="<?php echo get_yp_url('model', $r['modelid']);?>" target="_blank"><?php echo $r['name'];?></a>
			 <?php } ?>
			 <?php $n++;}unset($n); ?></div>
             <div class="login lh24 blue"><a href="<?php echo APP_PATH;?>index.php?m=content&c=rss&siteid=<?php echo get_siteid();?>" class="rss ib">rss</a><span class="rt"><script type="text/javascript">document.write('<iframe src="<?php echo APP_PATH;?>index.php?m=member&c=index&a=mini&forward='+encodeURIComponent(location.href)+'&siteid=<?php echo get_siteid();?>" allowTransparency="true"  width="500" height="24" frameborder="0" scrolling="no"></iframe>')</script></span></div>
    </div>
</div>
<div class="banner">
	<div class="content"<?php if($array[banner]) { ?> style="background-image:url(<?php echo $array['banner'];?>);"<?php } ?>>
    	<?php if($array[logo]) { ?><div class="logo picbig"><div class="img-wrap"><a href=""><img src="<?php echo $array['logo'];?>" /></a></div></div><?php } ?>
    	<h1<?php if($array[logo]) { ?> style="left:156px"<?php } ?>><?php echo $array['companyname'];?></h1>
        <h2>主营：<?php echo str_cut($array[products],100);?></h2>
    	<?php if(!$array[banner]) { ?><div class="ads"></div><?php } ?>
    </div>
</div>
<div class="nav">
    <ul class="content">
    <?php $menus = string2array($array['menu']); ksort($menus['list']);?>
	<?php $n=1; if(is_array($menus['list'])) foreach($menus['list'] AS $k => $v) { ?>
		<?php if($menus['catname'][$v]['used']=='1') { ?>
		<?php if($n!=1) { ?><li class="line"></li><?php } ?>
		<li><a href="<?php echo $menus['catname'][$v]['linkurl'];?>" ><?php echo $menus['catname'][$v]['catname'];?></a></li>
		<?php } ?>
	<?php $n++;}unset($n); ?>
    </ul>
</div>
<div class="bk10"></div>