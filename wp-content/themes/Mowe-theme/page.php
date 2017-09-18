<?php get_header(); ?>
	<div class="page-txt">
		<?php while (have_posts()) : the_post(); ?>
		<article>
			<h2 class="font-abc page-title"><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</article>
		<?php endwhile; ?>
	</div>
<?php get_footer(); ?>