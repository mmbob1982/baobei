<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php $tpl_dir = $this->default_tpl;?>
<?php include template($tpl_dir, 'header'); ?>
<div class="main clear">
  <div class="col-auto">
  	<?php include template('yp/com_default', 'block_contact'); ?>
   	  <h2 class="crumbs">¹«Ë¾½éÉÜ<span>/ABOUTUS</span></h2>
      <div class="about">
      	<?php echo $array['introduce'];?>
   	  </div>
    </div>
</div>
<?php include template('yp/com_default', 'footer'); ?>