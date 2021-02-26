<?php
/*
Plugin Name:  Jots Team
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Jots Team Member Plugin.
Version:      1.1
Author:       Kashish Kharbanda
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Domain Path:  /languages
*/
if ( !defined( 'ABSPATH' ) ) {
  die( 'Direct access is forbidden.' );
}
	add_action('wp_enqueue_scripts', 'jtbg_assets');
    function jtbg_assets(){
    	$plugin_urltry = plugin_dir_url( __FILE__ );
			wp_enqueue_style( 'jtstyle',  $plugin_urltry . "assets/css/main.css");
		    wp_enqueue_style( 'jtfontawesome',  "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css");
			wp_enqueue_script( 'jtpmainjs', $plugin_urltry . "assets/js/customjs.js", array(), '1.0.0', false );
    }

	add_shortcode( 'jots_team', 'jots_team_shortcode_make' );
	function jots_team_shortcode_make( $atts ) {
	ob_start();
	$a = shortcode_atts( array( 'types' => 'jotsteam', 'count' => '30', 'order' => 'ASC'), $atts );	
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => $a['types'],
			'posts_per_page' => $a['count'],
			'order' => $a['order'],	
			'paged' => $paged		
		);
		$counter = 0;
		$query = new WP_Query( $args );
		?><div class="jotteam"><div class="jotteamcon"><?php
			if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); 
			$teamdesg = get_post_meta(get_the_ID(), 'jdis_box', true);
			$featured_urls = get_the_post_thumbnail_url(get_the_ID(),'full');
			$alts = get_post_meta ( get_the_ID(), '_wp_attachment_image_alt', true );
			?>
				<div class="teamitem">
					<?php if(!empty($featured_urls)) { ?><img class="teamimage" data-num="<?php echo $counter; ?>" src="<?php echo $featured_urls; ?>" alt="<?php echo $alts; ?>"  srcset="" /><?php } ?>
					<div class="teaminfo">
						<h2><?php the_title(); ?></h2>
						<?php if(!empty($teamdesg)) { ?> <h3> <?php echo $teamdesg; }?></h3>
						<img class="underhdimage" src="https://www.johnnyrentals.com/development-sandbox/wp-content/uploads/2020/11/header-underline.png" alt="jots">
						<p><?php the_content(); ?></p>
					</div>
				</div>
			<?php $counter++; }} wp_reset_postdata(); ?>
			</div>
			<div class="popup" id="popupteam">
				<div class="popupcontent">
					<div class="popmaincontent">
						<div class="popimage"><img id="popimg" data-pop="" src="" alt=""></div>
						<div id="popcon"></div>
					</div>
					<span class="arrow-left" id="prev"><i class="fa fa-angle-double-left"></i></span>
					<span class="arrow-right" id="next"><i class="fa fa-angle-double-right"></i></span>
					<span class="close" id="close"><i class="fa fa-times"></i></span> 
				</div>
			</div>
		</div>
			<?php
	return ob_get_clean(); 
	}
	
	// Add Metabox In  Post
	function jots_team_add_meta_box() {
	add_meta_box( 
		'jots_mata',
		__( "More Information" , 'jots_team' ),
		'jotsteam_meta_box_callback',
		'jotsteam', 'advanced', 'high'
	);
}
add_action( 'add_meta_boxes', 'jots_team_add_meta_box' );

function jotsteam_meta_box_callback( $post ) {
	wp_nonce_field( 'post_meta_box', 'post_meta_box_nonce' );
	?>
		<p><label for="jdis_box"><b style="font-size: 16px;font-weight: bold;"><?php _e('Member Designation:', 'jots_team'); ?></b></label></p>
		<p><input style="height: 40px;" class="widefat" type="text" name="jdis_box" id="jdis_box" value="<?php echo get_post_meta($post->ID, 'jdis_box', true); ?>" placeholder="CO-OWNER" /></p>
	<?php
}

add_action('save_post', 'jots_team_save_meta_box_data');
function jots_team_save_meta_box_data($id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['jdis_box']))
    update_post_meta($id, 'jdis_box', $_POST['jdis_box']);
}

function jotsteam_setup_post_type() {
    
	register_post_type( 'jotsteam', [
	'public' => false, 
	'publicly_queryable' => true,  
	'show_ui' => true, 
	'exclude_from_search' => true, 
	'show_in_nav_menus' => false, 
	'has_archive' => false,  
	'rewrite' => false,
    'menu_icon' => 'dashicons-admin-users',
	'menu_position' => 5,
	'supports' => array( 'title', 'editor', 'thumbnail' ),
	'labels' => jotstem_cpt_labels(),
 ] );
	
}
add_action( 'init', 'jotsteam_setup_post_type' );


function jotstem_cpt_labels() {
 return [
 'name' => _x( 'Teams', 'Post type general name', 'jots_team' ),
 'singular_name' => _x( 'Team', 'Post type singular name', 'jots_team' ),
 'menu_name' => _x( 'Jots Team', 'Admin Menu text', 'jots_team' ),
 'name_admin_bar' => _x( 'Team', 'Add New on Toolbar', 'jots_team' ),
 'add_new' => __( 'Add New Team', 'jots_team' ),
 'add_new_item' => __( 'Add New Team', 'jots_team' ),
 'new_item' => __( 'New Team', 'jots_team' ),
 'edit_item' => __( 'Edit Team', 'jots_team' ),
 'view_item' => __( 'View Team', 'jots_team' ),
 'all_items' => __( 'All Teams', 'jots_team' ),
 'search_items' => __( 'Search Teams', 'jots_team' ),
 'parent_item_colon' => __( 'Parent Teams:', 'jots_team' ),
 'not_found' => __( 'No reviews found.', 'jots_team' ),
 'not_found_in_trash' => __( 'No reviews found in Trash.', 'jots_team' ),
 'featured_image' => __( 'Team User Image', 'jots_team' ),
 'set_featured_image' => __( 'Team User image', 'jots_team' ),
 'remove_featured_image' => _x( 'Remove cover image', 'jots_team' ),
 'use_featured_image' => _x( 'Use as cover image', 'jots_team' ),
 ];
}