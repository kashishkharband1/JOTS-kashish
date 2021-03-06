<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Parlo
 */

get_header();


// Layout
$blogsidebar = parlo_get_option( 'parlo_blog_layout', 'bloglayout', 'right' );
switch ( htmlspecialchars( $blogsidebar ) ) {
	case 'left':
		if( !is_active_sidebar( 'sidebar-1' ) ){
			$blog_wrapper_class = 'ht-col-md-12 ht-col-xs-12';
		}else{ $blog_wrapper_class = 'ht-col-md-9 ht-col-xs-12'; }
		break;

	case 'right':
		if( !is_active_sidebar( 'sidebar-1' ) ){
			$blog_wrapper_class = 'ht-col-md-12 ht-col-xs-12';
		}else{ $blog_wrapper_class = 'ht-col-md-9 ht-col-xs-12'; }
		break;

	default:
		$blog_wrapper_class = 'ht-col-md-12 ht-col-xs-12';
		break;
}

?>

	<div id="primary" class="content-area parlopage-padding">
		<main id="main" class="site-main">

			<div class="ht-container">
				<div class="ht-row">
					<?php if( $blogsidebar == 'left' && is_active_sidebar( 'sidebar-1' ) ): ?>
						<div class="ht-col-md-3 ht-col-xs-12">
							<?php get_sidebar();?>
						</div>
					<?php endif; ?>
					<div class="<?php echo esc_attr( $blog_wrapper_class ); ?>">
						<?php
							if ( have_posts() ) :

								echo '<div class="ht-row">';
									/* Start the Loop */
									while ( have_posts() ) :

										the_post();

											/*
											 * Include the Post-Type-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
											 */
											get_template_part( 'template-parts/content', get_post_type() );

									endwhile;
								echo '</div><div class="ht-row">';
									parlo_blog_pagination();
								echo '</div>';

							else :
								get_template_part( 'template-parts/content', 'none' );

							endif;
						?>
					</div>
					<?php if( $blogsidebar == 'right' && is_active_sidebar( 'sidebar-1' ) ): ?>
						<div class="ht-col-md-3 ht-col-xs-12">
							<?php get_sidebar();?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
