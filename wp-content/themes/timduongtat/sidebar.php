<div class="col-md-3 col-sm-3 col-xs-12">
    <div class="sidebar">
    <h3 style="margin: 5px 0;font-size: 16px; color: #40150F;font-size: 20px; border-bottom: 1px solid #40150F;">MENU</h3>
        <ul class="nav-menu menu-main-menu">
            <?php 
                              
    $args = array(
        'post_type'         => 'service',
        'post_status'       =>  'publish', 
        'meta_key'          => 'index_order',
        'orderby'           => 'meta_value_num',
        'order'             => 'ASC'
    );
$query = new WP_Query($args);
if (  $query->have_posts() ) :  
$i = 0;
while ( $query->have_posts() ) : $query->the_post(); 
                          
                                ?>

                <li>
                    <a href="<?php echo the_permalink(); ?>">
                        - <?php the_title(); ?>
                    </a>
                </li>


                <?php 

endwhile; 
endif;
wp_reset_query(); 
?>
        </ul>

    </div>
</div>