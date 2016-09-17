<?php
get_header();?>
    <div class="wrapper">
        <div id="contentwrapper">
            <div class="pagewrapper" style="    margin-top: 30px;">
                <div class="container">
                    <div class="row">
                     
                     <?php get_sidebar(); ?>
                    <?php
while ( have_posts() ) : the_post(); ?>

                        <div id="pageTitleDiv_social">
                            <div class="borderDIV">
                                <div class="pageTitle">
                                    <h1><?php the_title();?></h1></div>
                            </div>
                        </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php the_content();?>
                                 <div id="fb-root"></div>
                        <div data-width="100%" class="fb-comments" data-href="<?php echo get_permalink($post->ID); ?>" data-numposts="15"></div>
                            </div>
                            <div class="clearfix"></div>
                        
                        <?php endwhile;?>
                          
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>