<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template($tpl_dir, 'block_contact'); ?>
	<?php $b_type = array('1'=>'供应', '2'=>'求购', '3'=>'二手', '4'=>'促销',);?>
   	  <h2 class="crumbs">商机<span>/Business Opportunity</span></h2>
    <div class="sub-nav">商机分类：<a href="<?php echo compute_company_url('model');?>">全部</a><?php $n=1; if(is_array($catid_arr)) foreach($catid_arr AS $cid => $c) { ?><a href="<?php echo compute_company_url('model', array('catid'=>$cid));?>"><?php echo $CATEGORYS[$cid]['catname'];?>(<?php echo $c['num'];?>)</a>
	<?php $n++;}unset($n); ?></div>
              <div class="show-box">
    	<h1><?php echo $title;?> (<?php echo $b_type[$tid];?>)</h1> 

        <?php $type_arr = get_parent_url($modelid, $catid);?>
      <table width="100%" class="products-para" border="0">
       <caption>基本参数</caption>
        <tr><th width="15%">有效期：</th><td><?php echo $expiration;?></td><th width="15%">类别：</th><td><a href="<?php echo $CAT['url'];?>"><?php echo $type_arr['title'];?></a></td></tr>
        <tr><th>品牌：</th><td><?php echo $brand;?></td><th>型号：</th><td><?php echo $standard;?></td></tr>
        <tr><th>产地：</th><td><?php echo $yieldly;?></td><th>价格：</th><td><?php echo $price;?>元 <?php if($units) { ?>/ <?php echo $units;?> <?php } ?></td></tr>
        <tr><th>更新：</th><td><?php echo $updatetime;?></td><th></th><td></td></tr>
        <?php $j=1;?>
        <?php $n=1; if(is_array($additional_base)) foreach($additional_base AS $ab => $af) { ?>
            <?php if($j%2==1) { ?><tr><?php } ?><th><?php echo $additional_fields[$ab]['name'];?>：</th><td><?php echo $af;?></td><?php if($j%2==0) { ?></tr><?php } ?>
            <?php $j++;?>
        <?php $n++;}unset($n); ?>
      </table>

    <?php if($additional_general) { ?>
    <div class="bk10"></div>
			<table width="100%" class="products-para" border="0">
           <caption>基本参数</caption>
          <?php $n=1; if(is_array($additional_general)) foreach($additional_general AS $ag => $avalue) { ?>
          <?php if($n%2==1) { ?><tr><?php } ?>
            <th width="15%"><?php echo $additional_fields[$ag]['name'];?>：</th>
            <td width="35%">&nbsp;<?php echo $avalue;?></td>
          <?php if($n%2==0) { ?></tr><?php } ?>
		  <?php $n++;}unset($n); ?>
        </table>
        
        <?php } ?>
        <div class="bk10"></div>
            <div class="box">
                <h2 class="title">详细信息</h2>
                    <div class="content">
						<?php echo $content;?>
                    </div>
            </div>
    </div>
</div>
<div class="bk15"></div>
<?php include template($tpl_dir, 'footer'); ?>