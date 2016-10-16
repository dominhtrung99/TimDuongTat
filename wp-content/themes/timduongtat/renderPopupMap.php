<div class="popup-container">
    <div class="popup__top">
        <div class="navbar-top">
           <!-- <button class="back-btn btn-navbar"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>-->
               <p id="road-title"></p>
            <button class="close-btn btn-navbar"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            <div class="clear clearfix"></div>
        </div>
        <div class="tab-bar">
            <ul class="nav nav-tabs">
                <li ><a class="active" href="#map">Bản đồ</a></li>
                <li><a href="#guide">Hướng dẫn</a></li>
            </ul>
        </div>
    </div>
    <div class="road-map-wrapper container-fluid">
        <div class="row tab-content">
            <div id="map" class="col-md-8 col-xs-12">
                <div id="map-holder"></div>
				<div class="toolbox__map">
					<button id="geoLocation"><i class="fa fa-location-arrow" aria-hidden="true"></i></button>
				</div>
            </div>
            <div id="guide" class="road-info-wrapper">
                <div id="road-info">                    
                    <div class="road-meta">
                        <div class="road-rating road-element"></div>
                        <div class="road-element"><i class="fa fa-motorcycle" aria-hidden="true"></i>Quãng đường: <span class="distance road-node"></span></div>
                        <div class="road-element"><i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian: <span class="road-time road-node"></span></div>
                        <div class="road-element">
                            <i class="fa fa-road" aria-hidden="true"></i>Lộ trình: <span class="route road-node"></span>
                        </div>						
                        <div class="road-element"><i class="fa fa-sticky-note-o" aria-hidden="true"></i>Ghi chú: <span class="road-note"></span></div>
						<div class="road-element"><i class="fa fa-user" aria-hidden="true"></i><span class="road-author road-node"></span></div>
						<div class="road-element">						
							<span class="road-warming"></span>
							<div class="clearfix clear"></div>
						</div>
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