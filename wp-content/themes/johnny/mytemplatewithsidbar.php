<?php
/**
 Template Name: My template with sidebar
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */ 

get_header();

if( function_exists('parloSetPostViews') ){ parloSetPostViews( get_the_ID() ); }

//Layout
$blogdetailslayout = parlo_get_option( 'parlo_blogdetails_layout', 'blogdetailslayout', 'right' );
switch ( htmlspecialchars( $blogdetailslayout ) ) {
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
<?php 
	if ( has_post_thumbnail() ) {
     $imgURL = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
?>
	<header class="bannerimage_sec">
		<div class="sheaderbanner" style="background-image: url('<?php echo $imgURL; ?>');"></div>
	</header>
<?php }  ?>
	<div id="primary" class="content-area parlopage-padding">
		<main id="main" class="site-main">
			<div class="ht-container">
				<div class="ht-row">

					<?php if( $blogdetailslayout == 'left' && is_active_sidebar( 'sidebar-1' ) ): ?>
						<div class="ht-col-md-3 ht-col-xs-12">
							<?php get_sidebar();?>
						</div>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $blog_wrapper_class ); ?>">
						<div class="ht-row">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="grid-container">
					<div class="grid-x">
						<div class="cell small-12">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php if(have_rows('content_blocks')):  while ( have_rows('content_blocks') ) : the_row(); ?>
						<?php if(get_row_layout() == 'full_width_content_with_image'): ?>
								<section id="block_sec" class="full_width_content block_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<div class="contentrow">
											<div class="content_image" style="text-align: center;">
												<?php  if( have_rows('content') ): while( have_rows('content') ) : the_row(); ?>
												      	<?php $titlesub = get_sub_field('content_sub_title'); if ($titlesub) { ?>
														<h5 class="subtitle"> <?php echo $titlesub; ?> </h5>
														<?php } ?>
														<?php $title = get_sub_field('content_title'); if ($title) { ?>
															<h2> <?php echo $title; ?> </h2>
														<?php } ?>
														<?php $sepimagesss = get_sub_field('separator_image'); if ($sepimagesss) { ?>
															<img class="sepimage" src="<?php echo $sepimagesss['url'];?>" />
														<?php } ?>
														<?php the_sub_field("main_content"); ?>
													<?php endwhile; endif;?>
												<?php $image = get_sub_field('fimage');
													if( $image ): ?>
													<center><img src="<?php echo $image['url'];?>" /></center>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</section>
						<?php endif; ?>
						<?php
							if(get_row_layout() == 'callouts_columns'):?>
								<section id="block_sec" class="callouts_columns_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<div class="contentrow">
											<?php while(has_sub_field("callouts_con_area")): if(get_row_layout() == "calloutsbox"):?>
											<div class="one_third">
												<div class="content_image callouts_columnscontent">
													<?php $image = get_sub_field('callouts_image');?>
													<img src="<?php echo $image['url'];?>" />
													<h3><?php the_sub_field("callouts_title"); ?></h3>
													<p><?php the_sub_field("callouts_text"); ?></p>
													<a href="<?php the_sub_field("callout_button_link"); ?>"><?php the_sub_field("callout_button"); ?></a>
												</div>
											</div>
											<?php endif; endwhile; ?>
										</div>
									</div>
								</section>
						<?php endif; ?>
						<?php if(get_row_layout() == 'unit'): ?>
								<section id="block_sec" class="unit unit_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<div class="ht-row">
											<div class="ht-col-xs-12 ht-col-md-5">
												<div class="content_image imageright">
													<?php $image = get_sub_field('image_link');?>
													<img src="<?php echo $image['url'];?>" />
												</div>
											</div>
											<div class="ht-col-xs-12 ht-col-md-7">
												<div class="content_image">
													<?php  if( have_rows('content') ): while( have_rows('content') ) : the_row(); ?>
												      	<?php $title = get_sub_field('content_title'); if ($title) { ?>
														<h2 class="unithtwo"> <?php echo $title; ?> </h2>
														<?php } ?>
														<?php $maincon = get_sub_field('main_content'); if ($maincon) { ?>
															<p> <?php echo $maincon; ?> </p>
														<?php } ?>
													    <ul>											
														<?php 
															if( have_rows('listid') ):
																while ( have_rows('listid') ) : the_row();
																	 ?> <li><?php the_sub_field('list_item') ?> </li><?php
																endwhile;
															endif;
														?>
														</ul>
														<?php $titlesub = get_sub_field('subtitle'); if ($titlesub) { ?>
														<h4> <?php echo $titlesub; ?> </h4>
														<?php } ?>
														<ul>											
														<?php 
															if( have_rows('list_sid') ):
																while ( have_rows('list_sid') ) : the_row();
																	 ?> <li><?php the_sub_field('list_item') ?> </li><?php
																endwhile;
															endif;
														?>
														</ul>
														<?php $sepimage = get_sub_field('separator_image'); if ($sepimage) { ?>
															<img class="sepimage" src="<?php echo $sepimage['url'];?>" />
														<?php } ?>
													<?php endwhile; endif;?>
												</div>
											</div>
										</div>
									</div>
								</section>
						<?php endif; ?>
						<?php if(get_row_layout() == 'content_with_image'): ?>
								<section id="block_sec" class="content_with_image_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<div class="ht-row">
											<div class="ht-col-xs-12 ht-col-md-5">
												<div class="content_image" style="text-align: center;">
													<?php $image = get_sub_field('image_link');?>
													<img src="<?php echo $image['url'];?>" />
												</div>
											</div>
											<div class="ht-col-xs-12 ht-col-md-7">
												<div class="content_image">
													<?php  if( have_rows('content') ): while( have_rows('content') ) : the_row(); ?>
												      	<?php $titlesub = get_sub_field('content_sub_title'); if ($titlesub) { ?>
														<h5 class="subtitle"> <?php echo $titlesub; ?> </h5>
														<?php } ?>
														<?php $title = get_sub_field('content_title'); if ($title) { ?>
															<h2> <?php echo $title; ?> </h2>
														<?php } ?>
														<?php $sepimages = get_sub_field('separator_image'); if ($sepimages) { ?>
															<img class="sepimage" src="<?php echo $sepimages['url'];?>" />
														<?php } ?>
														<?php the_sub_field("main_content"); ?>
													<?php endwhile; endif;?>
												</div>
											</div>
										</div>
									</div>
								</section>
						<?php endif; ?>
						<?php
							if(get_row_layout() == 'content_withrt_image'):
								?>
								<section id="block_sec" class="content_right_image_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<div class="ht-row">
											<div class="ht-col-xs-12 ht-col-md-7">
												<div class="content_image">
													<?php the_sub_field("content"); ?>
												</div>
											</div>
											<div class="ht-col-xs-12 ht-col-md-5">
												<div class="content_image" style="text-align: center;">
													<?php $image = get_sub_field('image_link');?>
													<img src="<?php echo $image['url'];?>" />
												</div>
											</div>
										</div>
									</div>
								</section>
								<?php
							endif; ?>

						<?php if(get_row_layout() == 'unorderlist'): ?>
								<section id="block_sec" class="unorderlist_content_<?php echo get_row_index(); ?>" style="margin: 0px 0px 20px!important; padding: 0px!important;">
									<div class="ht-container">
									<div class="contentrow">
										<div class="content_image">
											<ul style="margin: 0px 10px!important; padding: 0px!important;">			
												<?php 
													if( have_rows('listname') ):
														while ( have_rows('listname') ) : the_row();
															 ?> <li><?php the_sub_field('list_item') ?> </li><?php
														endwhile;
													endif;
												?>
											</ul>
										</div>
									</div>
									</div>
								</section>
						<?php endif; ?>

						<?php
							if(get_row_layout() == 'orderlist'): ?>
								<section id="block_sec" class="orderlist_content_<?php echo get_row_index(); ?>" style="margin: 0px 0px 20px!important; padding: 0px!important;">
									<div class="ht-container">
									<div class="contentrow">
										<div class="content_image">
											<ol style="margin: 0px 10px!important; padding: 0px!important;">			
												<?php 
													if( have_rows('listname') ):
														while ( have_rows('listname') ) : the_row();
															 ?> <li><?php the_sub_field('list_item') ?> </li><?php
														endwhile;
													endif;
												?>
											</ol>
										</div>
									</div>
									</div>
								</section>
						<?php endif; ?>
			
						<?php
							if(get_row_layout() == 'resources'): ?>
								<section id="block_sec" class="only_content full_width_content_<?php echo get_row_index(); ?>">
									<div class="ht-container">
									<div class="contentrow">
										<div class="content_image">
											<?php  if( have_rows('content') ): while( have_rows('content') ) : the_row(); ?>
												<?php $titlesub = get_sub_field('content_sub_title'); if ($titlesub) { ?>
													<h5 class="subtitle"> <?php echo $titlesub; ?> </h5>
												<?php } ?>
												<?php $title = get_sub_field('content_title'); if ($title) { ?>
													 <h2 style="margin-left: 0px;"> <?php echo $title; ?> </h2>
												<?php } ?>
												<?php $sepimagess = get_sub_field('separator_image'); if ($sepimagess) { ?>
													<img class="sepimage" src="<?php echo $sepimagess['url'];?>" />
												<?php } ?>
												<?php the_sub_field("main_content"); ?>
													<?php endwhile; endif;?>
												<?php $image = get_sub_field('fimage');
													if( $image ): ?>
													<center><img src="<?php echo $image['url'];?>" /></center>
												<?php endif; ?>
										</div>
									</div>
									</div>
								</section>
						<?php endif; ?>
			
						<?php
							if(get_row_layout() == 'galleryl'): ?>
								<section id="block_sec" class="callouts_columns_<?php echo get_row_index(); ?>">
									<div class="ht-container">
									<div class="contentrow">
										<?php while(has_sub_field("gallery")): if(get_row_layout() == "galleryll"):?>
										<div class="one_third">
											<div class="content_image callouts_columnscontent">
												<?php $image = get_sub_field('gallery_images');?>
												<img src="<?php echo $image['url'];?>" />
											</div>
										</div>
										<?php endif; endwhile; ?>
									</div>
									</div>
								</section>
						<?php endif; ?>
			            
						<?php
							if(get_row_layout() == 'gallery_pro'): ?>
								<section id="block_sec" class="callouts_columns_<?php echo get_row_index(); ?>">
									<div class="ht-container">
									<div class="contentrow">
								<?php if( have_rows('gallery_box') ): while ( have_rows('gallery_box') ) : the_row(); ?>
										<div class="one_third" style="text-align: center;">
											<div class="content_image imagewith_title">
												<?php $image = get_sub_field('gallery_item');?>
												<a href="<?php the_sub_field("link"); ?>" style="display: block!important;">
													<img src="<?php echo $image['url'];?>" />
													<h3><?php the_sub_field("title"); ?> </h3>
												</a>
											</div>
										</div>
										<?php endwhile; endif; ?>
									</div>
									</div>
								</section>
						<?php endif; ?>
			            
						<?php
							if(get_row_layout() == 'gallery_prod'): ?>
								<section id="block_sec" class="gallery_columns_<?php echo get_row_index(); ?>">
									<div class="ht-container">
									<div class="contentrow">
								 		<?php $images = get_sub_field('gallery_box');
										if( $images ): ?>
												<?php foreach( $images as $image ): ?>
													<div class="one_third" style="text-align: center;">
														<a href="<?php echo $image['url']; ?>" style="margin-bottom: 0px;">
															 <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
														</a>
													</div>
												<?php endforeach; ?>
										<?php endif; ?>
									</div>
									</div>
								</section>
						<?php endif; ?>
							<?php if(get_row_layout() == 'contact_us'): ?>
								<section id="block_sec" class="content_with_image_<?php echo get_row_index(); ?>">
									<div class="ht-container">
										<?php $contact_heading = get_sub_field('heading'); if ($contact_heading) { ?>
														<h1 style="display: block; color: #000;"><?php echo $contact_heading; ?></h1>
														<?php } ?>
										<div class="ht-row">
											<div class="ht-col-xs-12 ht-col-md-7">
												<div class="content_image">
													<?php $contact_form = get_sub_field('contact_form'); if ($contact_form) { ?>
														<?php echo $contact_form; ?>
														<?php } ?>
													
												</div>
											</div>
											<div class="ht-col-xs-12 ht-col-md-5">
												<div class="content_image" style="text-align: center;">
													<?php $image = get_sub_field('image_link');?>
													<img src="<?php echo $image['url'];?>" />
												</div>
											</div>
										</div>
									</div>
								</section>
						<?php endif; ?>
			
				 <?php endwhile; endif; ?> <!-- end of content_blocks -->
		   <?php endwhile; endif; ?>
						</div>
					</div>
					
					<?php if( $blogdetailslayout == 'right' && is_active_sidebar( 'sidebar-1' ) ): ?>
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