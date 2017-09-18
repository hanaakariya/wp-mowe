<?php get_header(); ?>
	<div class="new-list">
		<?php get_sidebar(); ?>
		<section>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article>
				<figure><?php the_post_thumbnail('new_list'); ?></figure>
				<h2 class="list-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="list-info">
					<time><?php the_time('Y-m-d'); ?></time>
					<span class="meta-category <?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->category_nicename";} ?>"><?php the_category(', '); ?></span>
				</div>
				<p><?php echo mb_substr(strip_tags($post-> post_content),0,100).'...'; ?><a href="<?php the_permalink(); ?>">read more</a></p>
			</article>
			<?php endwhile; endif; ?>
			<?php include(TEMPLATEPATH . '/pager.php'); ?>
		</section>
	</div>
<?php get_footer(); ?>