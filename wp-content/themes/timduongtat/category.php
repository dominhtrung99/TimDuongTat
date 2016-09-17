<?php
get_header();?>
     <div class="wrapper content-page">
        <div id="contentwrapper">
            <div class="pagewrapper">
                <div class="container ">
				<div class="row">
				<div class="grid">
                    <?php  if (have_posts())  :  while (have_posts()) : the_post(); ?>
                          <div class="grid-item">
						<div class=" cms-grid-item">
                            <div class="cms-grid-media overlay-wrap has-thumbnail">
                                <a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($post->ID,array(500),array( 'class' => 'attachment-blog-grid wp-post-image' )); ?></a>
                            </div>
                           
                           <div style="padding:15px;">
						    <h4 class="cms-grid-title">
								<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							</h4>
						   <?php the_excerpt(); ?></div>
						   </div>
                        </div>
                        <?php endwhile; 
			else : ?>
                            <h2>Không tìm thấy!</h2>
                            <?php endif; ?>
 </div>
			</div>
			</div>
        </div>
    </div>
	 </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript">
    jQuery('.grid').imagesLoaded( function(){  
        jQuery('.grid').masonry({
          itemSelector: '.grid-item'
        });	  
    });
       </script>
    <?php get_footer(); ?>