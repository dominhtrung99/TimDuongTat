<?php 
/*Template Name: Confirm Page*/
get_header(); ?>
<div class="menu-road">
	<div class="col-md-4">
		<a href="https://timduongtat.com/"><i class="fa fa-road" aria-hidden="true"></i> Đường tắt mới chia sẻ</a>
	</div>
	<div class="col-md-4">
		<a href="https://timduongtat.com/duong-tat-xet-duyet/"><i class="fa fa-road" aria-hidden="true"></i> Đường tắt chờ xét duyệt</a>
	</div>
	<div class="clear clearfix"></div>
</div>
<div class="clear clearfix"></div>
<div class="card-listing">

</div>
 <div class="overllay">
        <div class="popup-wrapper map">
            <?php include 'renderPopupMap.php'; ?>
     </div>
</div>
<?php include __DIR__.('/../frontJs.php'); ?>
<script id="roadData" type="application/json">
<?php echo json_encode(getAllRoad(0)); ?>
</script>
<?php get_footer(); ?>