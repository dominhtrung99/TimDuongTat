<?php 
/*Template Name: Confirm Page*/
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
<div class="card-listing">

</div>
 <div class="overllay">
        <div class="popup-wrapper map">
            <div class="popup-container">
                <div class="navbar-top">
					<button class="back-btn btn-navbar" onclick="closePopup()"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>
					<button class="close-btn btn-navbar" onclick="closePopup()"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
					<div class="clear clearfix"></div>
				</div> 
                <div class="status-popup"></div>
                <div class="road-map-wrapper">
                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div id="map-holder"></div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div id="road-info">
                                <h3><i class="fa fa-street-view" aria-hidden="true"></i><span class="road-title"></span></h3>
                                <div class="road-meta">
                                    <div class="road-rating"></div>
                                    <div class=""><i class="fa fa-clock-o" aria-hidden="true"></i><span class="road-time"></span></div>
                                    <div><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="road-note"></span></div>
                                </div>
                                <div class="road-social">
                                    <div class="road-like"></div>
                                    <div class="road-comment"></div>
                                </div>
                                <!--
                                <div class="fb-like" data-href="http://timduongtat.com" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
		                        <div data-width="350" mobile="true"  class="fb-comments" data-href="http://timduongtat.com" data-numposts="15"></div>
                           -->
                            </div>                            
                        </div>
                    </div>
                                    
                </div>
            </div>
     </div>
</div>
<?php include __DIR__.('/../frontJs.php'); ?>
<script id="roadData" type="application/json">
<?php echo json_encode(getAllRoad(0)); ?>
</script>
<?php get_footer(); ?>