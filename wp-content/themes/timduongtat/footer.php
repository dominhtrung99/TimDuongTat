</div>
</div>
<footer class="tdt-footer">
	<div class="container">
		<div class="menu-footer ">
<?php 
$defaults = array(
	'menu'            => 'Footer menu',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="menu-footer-menu" class="nav-menu menu-main-menu">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>
			<div class="clear clearfix"></div>
		</div>
		<div class="copyright">
			<a href="http://timduongtat.com/">© 2016 Tìm Đường Tắt</a>
		</div>
	</div>
</footer>
<div class="tdt-cp">
    <div class="tdt-cp-box">
        Bạn muốn chia sẻ đường tắt cho mọi người cùng biết?
        <br> Hãy gửi cho chúng tôi.
        <div class="tdt-cp-go">
            <a href="<?php echo get_permalink(6); ?>">Gửi ngay</a>
        </div>
        <div class="tdt-cp-close"></div>
    </div>
    <div class="tdt-cp-expander off">
        Chia sẻ đường tắt
    </div>
</div>
<script>
jQuery(function($) {
	if($(window).width() < 768){
        Cookie.set('pop_c_close', 'true');
    };
});
</script>
<script>
    (function ($) {
		var $popUp = $('.tdt-cp');
		if( Cookie.get('pop_c_close') ) {
			showExpander($popUp);
		}
		setTimeout(function() {
			$popUp.removeClass('tdt-hidden');
		}, 3000);
		
        $('body').on('click', '.tdt-cp-close', function () {
            $this = $(this);
            $this.closest('.tdt-cp-box').addClass('collapse');
            Cookie.set('pop_c_close', 'true');
            setTimeout(function () {
                $this.closest('.tdt-cp').find('.tdt-cp-expander').removeClass('off');
            }, 500);
        });
		$('body').on('click', '.tdt-cp-expander', function () {
			$this = $(this);
			$this.addClass('off');
			Cookie.remove('pop_c_close');
			setTimeout(function () {
				$this.closest('.tdt-cp').find('.tdt-cp-box').removeClass('collapse');
			}, 500);
		});
		function showExpander($pop) {
			$pop.find('.tdt-cp-expander').removeClass('off');
			$pop.find('.tdt-cp-box').addClass('collapse');
		}
    })(jQuery);
	
	jQuery(function($) {
		
	});
</script>
<script src="https://use.fontawesome.com/fc9a188c99.js"></script>
<?php wp_footer(); ?>
    </body>

    </html>