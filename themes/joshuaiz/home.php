<?php
/*
Template Name: Home Page Sidebar
*/
?>

<?php get_header(); ?>

		<?php get_sidebar(); ?>

			<div id="content" class="columns">

				<div id="inner-content" class="clearfix">

						<div id="main" class="first clearfix columns" role="main">

							<section class="sticky-post clearfix">

								<?php 
								// the above is needed for wp_pagenavi to work (see the call below as well)
									// WP_Query arguments
										// $args = array (
										// 	'post_type'              => 'post',
										// 	'post_status'            => 'published',
										// 	'category_name'          => 'words',
										// 	'posts_per_page'         => '1',
											
										// );

										$args = array(
											'posts_per_page' => 1,
											'post__in'  => get_option('sticky_posts'),
											'caller_get_posts' => 1
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
	
										<h1 class="entry-title single-title h2" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
										<p class="byline vcard"><?php
											printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
										?></p>
	
									</header>
	
									<section class="entry-content clearfix" itemprop="articleBody">
										<?php the_content(); ?>
									</section>
	
									<footer class="article-footer">
										
	
									</footer>

	
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

							</section>

							<section class="posts wrap clearfix">
		
							<div class="align-right post-navi">
								<a href="/category/words/">See All Posts &rarr;</a>
							</div>

								<?php 
									// WP_Query arguments
										$args = array (
											'post_type'              => 'post',
											'post_status'            => 'publish',
											'post__not_in'           => get_option( 'sticky_posts' ),
											'posts_per_page'         => '3',
											
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
	
										<h1 class="entry-title single-title h2" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
										<p class="byline vcard"><?php
											printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', ') );
										?></p>
	
									</header>
	
									<section class="entry-content clearfix" itemprop="articleBody">
										<?php the_excerpt(); ?>
									</section>
	
									<footer class="article-footer">
										
	
									</footer>

	
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


							</section>

							<section class="insert music">
								<a href="http://soundcloud.com/joshuaiz/love-is-stronger" class="sc-player bioplayer"></a>
								<a href="https://soundcloud.com/joshuaiz/joshua-iz-feat-diz-it-iz-what-it-iz-radio-edit" class="sc-player bioplayer"></a>
								<a href="https://soundcloud.com/joshuaiz/joshua-iz-at-sleaze-please-2" class="sc-player bioplayer"></a>
								<a class="float-right" href="/music/">More Music &rarr;</a>
							</section>

						</div>
						<div id="secondary" class="last clearfix columns">
							<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->

							<section class="blurbs">

								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<section class="entry-content blurb-content">

										<h3>Latest Blurbs</h3>
	
										<ul class="list-square blurb-list">

								<?php 
									// WP_Query arguments
										$args = array (
											'post_type'              => 'blurb',
											'post_status'            => 'publish',
											'posts_per_page'         => '-1',
											
										);
										
										// The Query
										$temp = $wp_query;
										$wp_query= null;
										$wp_query = new WP_Query($args);
										
										// The Loop
										if ( $wp_query->have_posts() ) {
											while ( $wp_query->have_posts() ) {
												$wp_query->the_post(); ?>
								
											<li class="blurb-title" itemprop="headline"><?php the_title(); ?></li>
	
									
											<? }
										} ?>

									
										
										<?php // Restore original Post Data ?>
										<?php wp_reset_postdata(); ?>

										</ul>

										</section>
	
								</article>


							</section>
						</div>

				</div>

			</div>

<?php get_footer(); ?>