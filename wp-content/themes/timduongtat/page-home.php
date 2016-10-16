<?php 
/*Template Name: Home Page*/
get_header(); ?>
<div class="menu-road">
	<div class="col-md-4">
		<a href="http://timduongtat.com/"><i class="fa fa-road" aria-hidden="true"></i> Đường tắt mới chia sẻ</a>
	</div>
	<div class="col-md-4">
		<a href="http://timduongtat.com/duong-tat-xet-duyet/"><i class="fa fa-road" aria-hidden="true"></i> Đường tắt chờ xét duyệt</a>
	</div>
	<div class="clear clearfix"></div>
</div>
<div class="clear clearfix"></div>
<div class="row">
    <div class="card-listing">
        <img class="loading" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/loading.gif" />
    </div>
</div>
<div class="clear clearfix"></div>
<button id="all__road">Tìm lại</button>
 <div class="overllay">
        <div class="popup-wrapper map">
            <?php include 'renderPopupMap.php'; ?>
     </div>
</div>
<script id="roadData" type="application/json">
<?php echo json_encode(getAllRoad(1)); ?>
</script>
<?php include 'frontJs.php'; ?>
<?php get_footer(); ?>