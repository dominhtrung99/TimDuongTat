<?php
get_header();?>
    <div class="wrapper">
        <div id="contentwrapper">
            <div class="pagewrapper">
                <div class="container">
                   <div class="row">
                    <div class="col-md-12 entry-media entry-feature-image">
<?php echo get_the_post_thumbnail($post->ID, 'full',array( 'class' => 'attachment-blog-grid wp-post-image' )); ?>
                       <div class="clear"></div>
                        </div>
                     <?php get_sidebar(); ?>
                   
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            
                        <div id="pageTitleDiv_social">
                            <div class="borderDIV">
                                <div class="pageTitle">
                                    <h1><?php the_title();?></h1></div>
                            </div>
                        </div>
                            <?php the_content();
                            echo do_shortcode('[booking]');
                            ?>
                               
                                <div class="fb-like" data-href="<?php echo get_permalink($post->ID); ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                <div class="fb-share-button" data-href="<?php echo get_permalink($post->ID); ?>" data-layout="box_count"></div>
                                 <div id="fb-root"></div>
                        <div data-width="100%" class="fb-comments" data-href="<?php echo get_permalink($post->ID); ?>" data-numposts="15"></div>
                        </div>
                         <div class="clearfix"></div>
                   
                            <?php edit_post_link('Sửa bài', '<p class="clearfix">', '</p>'); ?>
                            <div class="col-md-12">
                                <div class="related-product">
                        <h3 class="title"><span>Alo Care</span></h3>
                        
                        
<?php 
    $args = array(
        'post_type'         => 'post',
        'post_status'       =>  'publish', 
        'orderby'           => 'post_date',
        'order'             => 'DESC',
        'posts_per_page'    => 6,
           'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => wp_get_post_categories($post->ID)
                    )
                )
    );
$query = new WP_Query($args);
if (  $query->have_posts() ) :  
while ( $query->have_posts() ) : $query->the_post(); ?>
                       <div class="col-md-4 product">
                       <a href="<?php the_permalink() ?>">
                           <?php echo get_the_post_thumbnail($post->ID, 'thumb_570x240',array( 'class' => 'attachment-blog-grid wp-post-image' )); ?>
                       </a>
                       <h4>
                           <a href="<?php the_permalink() ?>"><?php the_title(); ?></a> 
                       </h4>
                       
                        </div>
<?php 
endwhile; 
endif;
wp_reset_query(); 
?>
                        </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_footer(); ?>