<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
	 <?php wp_head(); ?>
    <!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css?ver=<?php echo rand(); ?>">
     <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/frontend.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon.png" />    
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=583057728503812";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK95EfA-8pms8q8x_3jPOzkDsW1eOdHis&libraries=drawing,geometry"></script>
</head>
<body <?php body_class(); ?>>
    <header class="tdt-header">
        <div class="container">
           <div class="row">
           <div class="col-md-12">
            <div class="tdt-header-container">
                    
                        <div class="tdt-header-title ">
							<div class="logo">
								<h1><a href="<?php echo get_site_option('siteurl'); ?>" class="tdt-mute flex middle-xs">
								   <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" alt="tìm đường tắt" />
								</a></h1>
								<h2 class="tdt-site-des">Chia sẻ các đường tắt tránh kẹt xe ở Sài Gòn</h2>
							</div>
                        </div>
                        
                           <div class="user-link">
                            <?php if ( is_user_logged_in() ) { global $userdata; ?>
                            Chào bạn, <strong><?php echo $userdata->display_name; ?></strong>
                            <?php } else{
 do_action('oa_social_login');
							?>
                                <a href="<?php echo get_site_option('siteurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Google&redirect_to=<?php echo get_site_option('siteurl'); ?>">Đăng nhập</a>
                            <?php }
                            ?>
                               <a href="#">
                                <div class="tdt-circle b"></div>
                            </a>
                            <a href="#">
                                <div class="tdt-circle f"></div>
                            </a>
                        </div>
                </div>  
                  <div class="col-md-12">
                      <form id="search-box-form">
                    <div class="tdt-search-box">
                        <input id="tdt-search" placeholder="Nhập từ khóa. vd: ngã tư phú nhuận, ..." type="text">
                        <button></button>
                    </div>
                </form>
                  </div>
                </div>
            </div>
        </div>
    </header>
    <div class="eg-wrapper">
        <div class="container eg-container">
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=885274261603162";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
