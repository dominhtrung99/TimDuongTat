<?php

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}
add_theme_support( 'post-thumbnails' ); 
function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
//show_admin_bar( true );
	automatic_feed_links();	
// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   /* Remove admin bar */

	}
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
 // This theme uses wp_nav_menu() in one location.
     //Register menu
    function register_my_menus() {
      register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'extra-menu' => __( 'Extra Menu' ),
            'quick-link-menu' => __( 'Quick Link' ),
             'sidebar-menu' => __( 'Sidebar' )
        )
      );
    }
    add_action( 'init', 'register_my_menus' );

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-1',
        'after_title' => '',
		'name' => 'Footer 1'  
    ));
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-2',
        'after_title' => '',
		'name' => 'Footer 2'  
    ));
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-3',
        'after_title' => '',
		'name' => 'Footer 3'  
    ));
     register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-4',
        'after_title' => '',
		'name' => 'Footer 4'  
    ));
     register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-5',
        'after_title' => '',
		'name' => 'Footer 5'  
    ));
}
add_image_size('thumb_760x380',760,380,array( 'center', 'top' ));//news
add_image_size('thumb_283x284',283,283,array( 'center', 'top' ));//news

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}



function send_email(){  
if(isset($_POST['name'])){
    
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date = $_POST['date'];

    $to = get_settings('admin_email');
    $subject = '[Allure Japan] booking';
    $body = 
    'Name: '.$name.'<br />'. 
    'Phone: '.$phone . '<br />' . 
    'Email: '.$email . '<br />' ;
    'Number: '.$number . ' persons.<br />' ;
    'Date: '.$date . '.<br />' ;
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $body, $headers );
    
    $body2 = "Chào bạn ".$name.' !<br /><br />Bạn đã gửi yêu cầu đặt hẹn tới Allure Japan, chúng tôi sẽ liên lạc với bạn sớm nhất.<br /><br />Hotline: 0935 367 760';
     wp_mail( $email , '[Allure Japan] booking successful',  $body2 , $headers );
}
echo $out;
die();  
}  
add_action('wp_ajax_send_email', 'send_email'); 
add_action('wp_ajax_nopriv_send_email', 'send_email');


 if(ICL_LANGUAGE_CODE == 'vi'){ 
        $seemore = 'Xem thêm';
        $booking = 'Book now';
     }else if(ICL_LANGUAGE_CODE == 'en'){
        $seemore = 'See more';
        $booking = 'Book now';
    }else{  
        $seemore = '続きを見る';
        $booking = '予約';
} 

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );

//Khởi tạo function cho shortcode
function booking_shortcode() {
      
       $out = '<div class="qa-booking-form form-mini">
                                <div class="qa-tabs-box">
                                    <div id="mainTabNav" class="nav">
                                        <p class="booking-title"><button class="btn-booking btn-style btn">ĐẶT HẸN CHĂM SÓC DA</button></p>                                       
                                            <div class="divBlock">
                                                <p>Chỉ cần điền thông tin và chọn thời gian dưới đây, Alure sẽ liên hệ lại ngay nhé!</p>
                                              <form id="booking-form" method="post">
                                                 <div class="row">
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                          <input required="" type="text" name="username" placeholder="Họ tên" id="username">
                                                     </div>
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                           <input required="" type="text" name="phone" placeholder="Số điện thoại" id="phone">
                                                     </div>                                                     
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                        <input required="" type="email" name="email" placeholder="Email" id="email">
                                                     </div>                                                     
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                     <input required="" placeholder="Thời gian" name="date-s" id="date-search" class="span2" size="16" type="text" value="" readonly="" data-date="8-4-2016">
                                                     </div>
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                         <input required="" type="number" name="number" placeholder="Số người" id="number">
                                                     </div>
                                                     <div class="col-md-2 col-xs-6 col-sm-4">
                                                            <input type="submit" name="submit" value="Gửi" id="submit-button">
                                                     </div>
                                                 </div>
                                              </form>
                                                
                                        </div>

                                    </div>
                                </div>
                            </div>';
      echo $out; 
}

add_shortcode( 'booking', 'booking_shortcode' );

