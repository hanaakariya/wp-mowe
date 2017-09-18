<?php get_header(); ?>
	<div class="new-list">
		<?php get_sidebar(); ?>
		<section>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article>
				<figure><?php the_post_thumbnail('post_eyecatch'); ?></figure>
				<h2 class="list-title"><?php the_title(); ?></h2>
				<div class="list-info">
					<time><?php the_time('Y-m-d'); ?></time>
					<span class="meta-category <?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->category_nicename";} ?>"><?php the_category(', '); ?></span>
				</div>
				<p><?php the_content(); ?></p>
			</article>
		<?php endwhile; endif; ?>
		</section>
	</div>
<?php get_footer(); ?>