<?php
/*
Template Name: Blog Page
*/
?>

<?php get_header(); ?>

	<?php get_sidebar(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

								<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								// the above is needed for wp_pagenavi to work (see the call below as well)
									// WP_Query arguments
										$args = array (
											'post_type'              => 'post',
											'post_status'            => 'publish',
											'category_name'          => 'words',
											'pagination'             => true,
											'paged' 				 => $paged,
											'post__not_in'           => get_option( 'sticky_posts' ),
											'posts_per_page'         => '1',
											
										);
										
										// The Query
										$temp = $wp_query;
										$wp_query= null;
										$wp_query = new WP_Query($args);
										
										// The Loop
										if ( $wp_query->have_posts() ) {
											while ( $wp_query->have_posts() ) {
												$wp_query->the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<header class="article-header">
	
										<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
										<p class="byline vcard"><?php
											printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
										?></p>
	
									</header>
	
									<section class="entry-content clearfix" itemprop="articleBody">
										<?php the_content(); ?>
									</section>
	
									<footer class="article-footer">
										
										<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
	
									</footer>

										<section class="next-post">
											<?php related_posts(); ?>
											<a href="/category/words/">See All Posts &rarr;</a>
										</section>
										
										</section>
	
									<?php comments_template(); ?>
	
								</article>
											<? }
										} else { ?>
											<article id="post-not-found" class="hentry clearfix">
												<header class="article-header">
													<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
												</header>
												<section class="entry-content">
													<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
												</section>
												<footer class="article-footer">
													<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
												</footer>
											</article>
										<?php } ?>					
										
										<?php // Restore original Post Data ?>
										<?php wp_reset_postdata(); ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
