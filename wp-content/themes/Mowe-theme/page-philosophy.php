<?php
/*
Template Name: Philosophy
*/
?>
<?php get_header(); ?>
	<div class="page-txt">
		<?php while (have_posts()) : the_post(); ?>
		<article>
			<?php the_content(); ?>
		</article>
		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>