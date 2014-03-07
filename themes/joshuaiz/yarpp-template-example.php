<?php 
/*
YARPP Template: Simple
Author: mitcho (Michael Yoshitaka Erlewine)
Description: A simple example YARPP template.
*/
?>


<?php if (have_posts()):?>


	<?php while (have_posts()) : the_post(); ?>
		<section class="related related-single">
	
			<h6>Related Post</h6>
		
				<div class="inner-section">

					<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<?php print_excerpt(125); ?>
					<a href="<?php the_permalink(); ?>" rel="boookmark">Read Article &rarr;</a>

				</div>
		</section>
	<?php endwhile; ?>
			
	

<?php else: ?>
<?php endif; ?>

