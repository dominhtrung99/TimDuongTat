<?php
/*Template Name: Add road Page*/
get_header();?>
    <style type="text/css">
        #map-holder {
            height: 500px;
        }
    </style>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.form.js"></script>
    <div class="row">
        <div class="col-md-12 add-road-control-group-top">
            <button id="guide-add-road-button">Hướng dẫn</button>
            <button class="draw-again">Vẽ lại đường đi</button>
            <p class="tip"><i class="fa fa-info-circle" aria-hidden="true"></i>Double Click để vẽ xong</p>
        </div>
        <div class="col-md-12">
            <div id="map-holder"></div>
        </div>
    </div>
    <div id="guide-add-road" class="row" style="margin-top:30px;margin-bottom:30px">
        <div class="col-md-12">
            <h2>Hướng dẫn chia sẻ đường tắt</h2>
            <div class="main-content">
                  <?php
                   if (have_posts()) { ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="td-main-content-wrap td-main-page-wrap">
                            <div class="td-container">
                                <?php the_content(); ?>
                            </div>
                                <div class="td-container">
                                    <div class="fb-like" width="100%" data-href="http://timduongtat.com" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
		                          <div mobile="true" data-width="1" class="fb-comments" data-href="http://timduongtat.com" data-numposts="15"></div>

                                </div>
                                
                        </div> <!-- /.td-main-content-wrap -->


                    <?php endwhile; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="overllay">
        <div class="popup-wrapper add-road-popup">
            <div class="popup-container">
				<div class="navbar-top">
					<!--<button class="back-btn btn-navbar"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></button>-->
					<button class="close-btn btn-navbar"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
					<div class="clear clearfix"></div>
				</div>
                <div class="status-popup"></div>
                <div class="login-popup">
					<?php do_action( 'wordpress_social_login' ); ?>
                </div>
                <div class="add-road-wrapper">
                    <form enctype="multipart/form-data" id="addRoadForm" method="post" action="<?php echo get_site_option('siteurl'); ?>/add-road-ajax">
                        <input type="hidden" value="addRoadAjax" name="action" />
                        <input type="hidden" value="<?php rand(1,999); ?>" name="token" />
						<input type="hidden" value="" name="geoJson" />
                        <div class="row">
                           <div class="col-md-8 col-xs-12">
                                <div class="form-group">
                                    <input required type = "text" class = "form-control" placeholder = "Đoạn đường (Ngã 4 Hàng Xanh, Ngã 4 Bảy Hiền,...)" name = "roadTitle" id="road-title" />
                                    <small class="form-text text-muted">(*) Bắt buộc</small>
                                </div>
                                <div class="form-group">
								<div><strong>Mức độ an toàn</strong></div>
                                   <?php 
                                    $field = wpcf_admin_fields_get_field('issafe');
                                    foreach($field['data']['options'] as $key => $option) { ?>
                                         <div class="col-md-6">
											<input type="checkbox" name="issafe[]" value="<?php echo $option['set_value']; ?>"><?php echo $option['title']; ?>
										</div> 
                                    <?php }
                                  ?>
                                </div>
                                <div class="form-group">
                                    <textarea  class = "form-control" id="road-note" placeholder = "Ghi chú..." name = "roadNote"></textarea>
                                </div>
								<!--
                                <div class="form-group">
                                    <input type="number" min="0" class="form-control" placeholder="Thời gian" id="road-time" name = "roadTime" />
                                    <small class="form-text text-muted">Thời gian dự tính đi đường tắt. Đv: phút</small>
                                </div>
								-->
                           </div>
                           <div class="col-md-4 col-xs-12">
                                <img id="file-preview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/nophoto.png" />
                                <div class="form-group">
                                    <input type="file" id="file-upload"  class="file-image" name="fileUpload" value="Upload ảnh">
                                    <span id="status-upload"></span>
                               </div>
                           </div>
                       </div>
                       
                        <!--
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Hashtag (@KetXeHangXanh,...)" id="road-tag" name = "hashTag" />
                        </div>
                        -->
                        <button type="submit" class="btn btn-default">Gửi</button>
						<button class="btn btn-default draw-again">Vẽ lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function($) {
            // The Google Map.
            var map;
            var geoData = "";

            function init() {
                // Initialise the map.
                map = new google.maps.Map(document.getElementById('map-holder'), {
                    center: {
                        lat: 10.7729742,
                        lng: 106.536086
                    },
                    zoom: 11
                });
                map.data.setControls(['LineString']);
                map.data.setStyle({
                    editable: true,
                    draggable: true,
                    strokeColor: 'red',
                    strokeWeight: 5
                });
                bindDataLayerListeners(map.data);
              
            }
            
            function refreshGeoJsonFromData() {
                map.data.toGeoJson(function (geoJson) {
                    geoData = JSON.stringify(geoJson, null, 2);
					geoData	=	geoData.replace(/ /g, "").replace(' ', '').replace(/(\r\n|\n|\r)/gm,"");
                    console.log(geoData);
					$('input[name="geoJson"]').val(geoData);
                    showInfoForm();
                });
            }

            function bindDataLayerListeners(dataLayer) {
				
                dataLayer.addListener('addfeature', refreshGeoJsonFromData);
               // dataLayer.addListener('removefeature', refreshGeoJsonFromData);
               // dataLayer.addListener('setgeometry', refreshGeoJsonFromData);
                dataLayer.addListener('rightclick', test);
                
            }
function test(){
    console.log('dfdf');
}

            function showInfoForm() {
                <?php if (is_user_logged_in() ) { ?>
                    console.log(geoData);
                    $('.login-popup').hide();
                    $(".overllay, .popup-wrapper, .add-road-wrapper").css("visibility", "visible");
                <?php } else { ?>
                    $('.add-road-wrapper').hide();
                    $(".overllay, .popup-wrapper, .login-popup").css("visibility", "visible");
                <?php } ?>
            }
            
            function openStatusPopup(text) {
                $('.add-road-wrapper').hide();
                $(".add-road-wrapper").css("visibility", "hidden");
                $('.status-popup').html(text);
                $(".status-popup").show();
            }

            google.maps.event.addDomListener(window, 'load', init);
            
            var options = {
                beforeSubmit: showRequest,
                success: showResponse
            };
            jQuery('form#addRoadForm').ajaxForm(options);


            function showRequest(formData, jqForm, options) {
                var $form = jQuery('form#addRoadForm');
                return true;
            }
            function showResponse(response, statusText, xhr, $form) {
                console.log(response);
                //console.log(response);
                if(response.status  == 0) {
                    openStatusPopup(response.message);
                } else {
                    openStatusPopup(response.message);
                   // setTimeout(function(){ 
                     // window.location.href = '<?php echo get_site_option('siteurl'); ?>';
                  // }, 5000);
                }
                return true;
            }
            
			function refreshData() {
			  var newData = new google.maps.Data({
				map: map,
				style: map.data.getStyle(),
				controls: ['LineString']
			  });
			  
			  map.data.setMap(null);
			  map.data = newData;
			  bindDataLayerListeners(newData);
			}
			
			$(".draw-again").on( "click", function(e) {
				closePopup();
				return false;
				
			});
            
            $('#guide-add-road-button').on( "click", function(e) {
                $('html,body').animate({
                    scrollTop: jQuery("#guide-add-road").offset().top
                }, 500);
            });
			
			$(".button-close-popup, .back-btn, .close-btn").on( "click", function(e) {
				closePopup();
				return false;
				
			});
			
			function closePopup() {
				refreshData();
                $(".status-popup, .login-popup, .add-road-wrapper, .overllay, .popup-wrapper").css("visibility", "hidden");
				
                //$(".status-popup").show();
			}
            
            //**** UPLOAD IMAGE *******//
            document.getElementsByName("fileUpload")[0].onchange = function (evt) {
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    var f = evt.target.files[0]; 
                    var size = parseInt(f.size)/2048;
                    var name = f.name;
                    var type = f.type ;
                    // console.log(name);
                    if ((/\.(png|jpeg|jpg|gif)$/i).test(name) ){
                         if ((/\.(png|jpeg|jpg|gif)$/i).test(name) ){
                             document.getElementById("file-preview").src = e.target.result;

                         }
                         jQuery("#status-upload").html("");
                    }else{
                        jQuery("#status-upload").html("File không đúng định dạng");
                    }
                    if(size > 2048){
                        jQuery("#status-upload").html("Hình ảnh trên 2Mb");
                    }else{
                        jQuery("#status-upload").html("");
                    }

                };

                //read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            };

			
			<?php if (!is_user_logged_in() ) { ?>
				$('.add-road-wrapper').hide();
				$(".overllay, .popup-wrapper, .login-popup").css("visibility", "visible");
                hideIntro();
			<?php } else { ?>
				introDraw();
			<?php } ?>
			
			//$('.tdt-cp').find('.tdt-cp-expander').removeClass('off');
			//$('.tdt-cp').find('.tdt-cp-box').addClass('collapse');
            Cookie.set('pop_c_close', 'true');
        });
		function introDraw(){
			var element		=	$('#map-holder');
			var p			=	element.offset();
			$('.introjs-tooltipReferenceLayer').css({"top" : p.top, "left" : p.left, "width": element.width(), "height":element.height() });
			$('.intro-draw').show();
		}
		function hideIntro(){
			$('.intro-draw, .introjs-tooltipReferenceLayer').hide();
		}
        
	   
    </script>
	
	<div class="intro-draw"></div>
	<div class="introjs-tooltipReferenceLayer">
		<div style="position:relative">
			<span class="introjs-helperNumberLayer">1</span>
			<div class="introjs-tooltip"><div class="introjs-tooltiptext">Chọn biểu tượng <img src="https://timduongtat.com/wp-content/uploads/2016/09/step-button.jpg" /> để bắt đầu vẽ đường tắt</div>
				<div class="introjs-tooltipbuttons"><a href="javascript:void(0);" onclick="hideIntro()" class="introjs-button introjs-startbutton">Bắt đầu →</a></div>
			</div>
			
		</div>
	</div>
<?php get_footer(); ?>