<?php
get_header();?>
    <div class="page-wrapper">
        <div class="page-content">
		<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="entry-title" itemprop="name"><?php the_title();?></h1>
				
                     <?php //get_sidebar(); ?>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<?php the_content();?>
							 <div id="fb-root"></div>
					<div data-width="100%" class="fb-comments" data-href="<?php echo get_permalink($post->ID); ?>" data-numposts="15"></div>
						</div>
                     <div class="clearfix"></div>
				 <?php endwhile;?>
        </div>
    </div>
    <?php get_footer(); ?>