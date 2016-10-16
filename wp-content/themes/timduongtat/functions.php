<?php
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}
add_theme_support( 'post-thumbnails' ); 
function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
add_theme_support( 'automatic-feed-links' );	

function wpdocs_dequeue_script() {
if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	}
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );	

	// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');
    
// This theme uses wp_nav_menu() in one location.
 //Register menu
function register_my_menus() {
  register_nav_menus(
    array(
        'header-menu' => __( 'Header Menu' ),
        'extra-menu' => __( 'Extra Menu' ),
        'quick-link-menu' => __( 'Quick Link' ),
         'sidebar-menu' => __( 'Sidebar' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-1',
        'after_title' => '',
		'name' => 'Footer 1'  
    ));
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-2',
        'after_title' => '',
		'name' => 'Footer 2'  
    ));
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-3',
        'after_title' => '',
		'name' => 'Footer 3'  
    ));
     register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-4',
        'after_title' => '',
		'name' => 'Footer 4'  
    ));
     register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
		'id'=>'footer-5',
        'after_title' => '',
		'name' => 'Footer 5'  
    ));
}
add_image_size('thumb_258x194',258,194,array( 'center', 'top' ));


function substrwords($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return $output;
}


// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );


function getAllRoad($confirm = 1) {
	global $post;
    $data   =   array();
   
    $args   =   array(
                    'post_type' => 'road',
                    'post_status' =>  'publish',										
                    'posts_per_page' => -1,
                    'order' => 'DESC', 	
                    'orderby' => 'post_date',
					'meta_query' => array(
					array(
						'key'     => 'wpcf-confirm',
						'value'   => $confirm,
						'compare' => '=',
						'type'    => 'NUMERIC'
					),
			)
    );
    query_posts( $args );
    
    while ( have_posts() ) : the_post();
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'thumb_258x194', true);
		$image	=	$thumb_url[0];
	} else {
		$image	=	"http://timduongtat.com/wp-content/themes/timduongtat/images/nophoto.png";
	}
	
	$warming	=	'<ul><li>'. types_render_field('issafe', array('separator'=>'</li><li>')) .'</li></ul>';
	//print_r(($custom_fields['wpcf-issafe']));
	
	
	
   $custom_fields = get_post_custom($post->ID);
   $data[$post->ID] =  array(
		'id'	=>	$post->ID,
		'title' =>  get_the_title(),
		'note'  =>  $post->post_content,
		'url'   =>  get_permalink(),
		'geoJson'   =>  json_decode($custom_fields['wpcf-geojson'][0]),
		'image'		=>	$image,
		'author'    =>  get_the_author(),
		'warming'	=>	$warming
	);
    
    endwhile;
    wp_reset_query();
    return $data;
}
