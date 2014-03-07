<?php
/*
Template Name: No Secondary Page
*/
?>

<?php get_header(); ?>

		<?php get_sidebar(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="twelvecol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>
									<!-- <p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link() );
									?></p> -->


								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<!-- <p class="clearfix"><?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p> -->

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

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

							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
<script>
jQuery(document).ready(function($){

	if($('djgigs-table-trigger').text() == "-") {
		// toggle #sidebar1 height when we add more content; equalHeight doesn't work here
  			$("#sidebar1").animate({height:'+=500'}, 300);
  		} else {

			// remove extra height once collapsed
			$("#sidebar1").animate({height:'-=500'}, 300);
		});
});
</script>