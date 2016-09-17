<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css">
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/images/favicon.png" />
   <script src="https://use.fontawesome.com/fc9a188c99.js"></script>

    <?php wp_head(); ?>
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
</head>
<body <?php body_class(); ?>>
<header class="mqc-header">
		<div class="mqc-header-container">

			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="mqc-header-title">
						<a href="http://www.mauquangcao.com/" class="mqc-mute flex middle-xs">
							<img src="http://www.mauquangcao.com/wp-content/plugins/wr-easy-gallery//assets/img/logo.png" width="60" height="37" alt="Mẫu quảng cáo">Mẫu quảng cáo
						</a>
						<h1 class="mqc-site-des">Thư viện mẫu quảng cáo Facebook chọn lọc</h1>
					</div>
				</div>

				<div class="col-sm-6 col-xs-12">
					<div class="mqc-social">
						<a href="http://www.mauquangcao.com/blog">
							<div class="mqc-circle b"></div>
						</a>
						<a href="https://www.facebook.com/mauquangcao/?fref=ts">
							<div class="mqc-circle f"></div>
						</a>
					</div>
				</div>
			</div>

			<div class="mqc-search-box">
				<input id="ad-search" placeholder="Nhập từ khóa" type="text">
				<button></button>
			</div>

			<div class="row mqc-filters">


				<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="mqc-select">
						<select name="" id="ad-career">
							<option value="">Tất cả lĩnh vực, ngành nghề</option>
														<option value="3">Công Nghệ</option>
														<option value="8">Dịch Vụ</option>
														<option value="10">Du lịch - Giải Trí</option>
														<option value="22">Đồ Ăn - Đồ Uống</option>
														<option value="9">E-commerce</option>
														<option value="23">Game - ứng dụng</option>
														<option value="20">Giáo dục - Cộng đồng</option>
														<option value="14">Khác</option>
														<option value="15">Nhà cửa - Vật dụng gia đình</option>
														<option value="31">Phụ kiện - Đồ chơi - Xe cộ</option>
														<option value="18">Thể Dục - Thể Thao</option>
														<option value="19">Thời Trang - Làm Đẹp</option>
														<option value="24">Y tế, thuốc và sức khỏe</option>
													</select>
					</div>
									</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="mqc-select">
						<select name="" id="ad-purpose">
							<option value="">Tất cả mục đích quảng cáo</option>
														<option value="4">Kinh doanh sản phẩm/dịch vụ</option>
														<option value="11">Sự kiện, cuộc thi, tuyển dụng</option>
														<option value="12">Tăng người theo dõi, lượt truy cập trang</option>
													</select>
					</div>
									</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="mqc-select">
						<select name="" id="ad-type">
							<option value="">Tất cả loại hình quảng cáo</option>
														<option value="5">Quảng cáo bài viết</option>
														<option value="30">Quảng cáo Game, ứng dụng</option>
														<option value="7">Quảng cáo Link website</option>
														<option value="16">Quảng cáo sự kiện</option>
														<option value="17">Quảng cáo trang</option>
														<option value="25">Quảng cáo video</option>
													</select>
					</div>
									</div>

				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="mqc-select">
						<select name="" id="ad-base">
							<option value="">Tất cả kiểu quảng cáo</option>
							<option value="image">Ảnh</option>
							<option value="embed">Link nhúng</option>
						</select>
					</div>
				</div>
			</div>
			
			<!-- <div class="social-share-bar">
				<div class="mqc-share facebook-share">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-share-button" data-href="http://www.mauquangcao.com/ad/" data-layout="button"></div>
				</div>

				<div class="mqc-share twitter-share">
					<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				</div>

				<div class="mqc-share google-share">
					<script src="https://apis.google.com/js/platform.js" async defer></script>
					<div class="g-plusone" data-size="tall" data-annotation="none"></div>
				</div>
				<div class="mqc-share linkedin-share">
					<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
					<script type="IN/Share"></script>
				</div>
			</div> -->

		</div>
	</header>
	<div class="eg-wrapper">