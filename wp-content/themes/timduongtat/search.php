<?php
get_header();?>
  <div class="wrapper">
        <div id="contentwrapper">
            <div class="pagewrapper">
                <div class="container">
<?php
// Start the Loop.
while ( have_posts() ) : the_post(); ?>

	   <div id="pageTitleDiv_social">
                            <div class="borderDIV">
                                <div class="pageTitle">
                                    <h1><?php the_title();?></h1></div>
                            </div>
                        </div>
			<?php the_content();?>

<?php endwhile;?>

                </div>
            </div>
        </div>
<?php get_footer(); ?>