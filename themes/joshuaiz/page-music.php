<?php
/*
Template Name: Music Page
*/
?>

<?php get_header(); ?>

		<?php get_sidebar(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<section class="soundcloud">
									<h3>Joshua Iz Tracks</h3>
									<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/23216374&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
									<h3>Joshua Iz Mixes</h3>
									<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/15036&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
								</section>

								<footer class="article-footer">

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
						<div id="secondary" class="last clearfix columns recent">
							<section class="releases">
								<h3>Recent Releases</h3>
								<section class="release">
									<div class="release-image float-left">
										<a href="http://vizualrecords.com/catalog/eps/viz018/"><img src="<?php echo 	get_template_directory_uri(); ?>/library/images/VIZ018_Cover_Art_48.png" width="48px" height="48px"></a>
									</div>
									<div class="release-info">
										<h4><a href="http://vizualrecords.com/catalog/eps/viz018/">Joshua Iz feat. Diz - Love Is Stronger/Bouncy Castles</a></h4>
										<p>VIZ018 <span class="separator">|</span> Vizual Records <span class="separator">|</span> <a href="http://vizualrecords.com/catalog/eps/viz018/">Buy Now</a></p>
									</div>
								</section>
								<section class="release">
									<div class="release-image float-left">
										<a href="http://vizualrecords.com/catalog/eps/viz017/"><img src="<?php echo 	get_template_directory_uri(); ?>/library/images/VIZ017_Cover_Art_48.png" width="48px" height="48px"></a>
									</div>
									<div class="release-info">
										<h4><a href="http://vizualrecords.com/catalog/eps/viz018/">Free Energy - How U Do It</a></h4>
										<p>VIZ017 <span class="separator">|</span> Vizual Records <span class="separator">|</span> <a href="http://vizualrecords.com/catalog/eps/viz017/">Buy Now</a></p>
									</div>
								</section>
								<section class="release">
									<div class="release-image float-left">
										<a href="http://vizualrecords.com/catalog/eps/viz014/"><img src="<?php echo 	get_template_directory_uri(); ?>/library/images/VIZ014_Cover_Art_48.png" width="48px" height="48px"></a>
									</div>
									<div class="release-info">
										<h4><a href="http://vizualrecords.com/catalog/eps/viz018/">Joshua Iz feat. Jamalski - We 	Control (The J-Boom Sessions)</a></h4>
										<p>VIZ014 <span class="separator">|</span> Vizual Records <span class="separator">|</span> <a href="http://vizualrecords.com/catalog/eps/viz014/">Buy Now</a></p>
									</div>
								</section>
							</section>
							<h3>Audio Mastering</h3>
							<section class="item-group">
								<section class="release">
									<div class="release-image float-left">
										<a href="http://highbiasmastering.com/"><img src="<?php echo get_template_directory_uri(); ?>/library/images/hbm_96.png"></a>
									</div>
									<div class="release-info">
										<h4><a href="http://highbiasmastering.com">High Bias Mastering</a></h4>
										<p>Expert audio mastering for digital. <a href="http://highbiasmastering.com/upload/">Upload</a> your project today.</p>
									</div>
								</section>
							</section>
							<h3>More Stuff</h3>
							<section class="item-group">
								<section class="release">	
								<ul class="no-style">
									<li><a href="http://joshuaiz.com/files/Joshua_Iz_press_pack.zip"><img class="download-img" src="<?php echo 	get_template_directory_uri(); ?>/library/images/file.png" width="24px" height="32px">Download the Joshua Iz<br>Press Pack</a></li>
									<li></li>
									<li></li>
								</ul>
								</section>
							</section>
							 
						</div>

				</div>

			</div>

<?php get_footer(); ?>
<!-- <script type="text/javascript">
	jQuery(document).ready(function($){
		$.equalHeightColumns('destroy');
  		$('#content, #sidebar1, #secondary').equalHeightColumns();
 	 	// $.equalHeightColumns('refresh');
});
</script> -->