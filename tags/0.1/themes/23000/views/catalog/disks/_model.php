<?php
$params = array('catalog/disks', 'aliasProducer'=>$data->producer->alias, 'aliasModel'=>$data->alias);
!empty($construct)?$params['construct']=$construct:false;
?>

<h3 class='grid_4 <?php echo $index%2?'omega':'alpha'; ?> tcenter'>
	<?php if(!empty($data->photo)): ?>
	<div class='tb'><a href='<?php echo CHtml::normalizeUrl($params); ?>'><?php echo CHtml::image( Image::getFile($data->photo, 'small'), $data->title ); ?></a></div>
	<?php endif;?>

	<?php 
	echo CHtml::link($data->title, $params);
	?>
</h3>
<?php echo $index%2?'<div class="clear"></div>':''; ?>