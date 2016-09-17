<?php
/*Template Name: Skin Grasp Page*/

get_header();?>
   <div class="wrapper content-page">
        <div id="contentwrapper">
            <div class="pagewrapper">
                <div class="container ">
				<div class="row">
				<div class="grid">
                     <?php 
                              
    $args = array(
        'post_type'         => 'post',
        'post_status'       =>  'publish', 
        'cat'               => array(20),
        'orderby' => 'ID',
        'order'             => 'DESC'
    );
$query = new WP_Query($args);
if (  $query->have_posts() ) : 
while ( $query->have_posts() ) : $query->the_post(); 
?>
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
                 <?php endwhile; endif; wp_reset_query();  ?>
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