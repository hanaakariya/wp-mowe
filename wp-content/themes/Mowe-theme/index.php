<?php get_header(); ?>
<div class="container">
	<!-- トップバナー -->
	<?php dynamic_sidebar('topbanner'); ?>
	<!-- ここから新着記事リスト -->
	<section class="mainbooth">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
		<article class="articlelist">
			<?php if(in_category(array('5','4'))): //カテゴリinfoとEVENTの時の表示 ?>
				<div class="list-info">
					<span class="meta-category <?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->category_nicename";} ?>"><?php the_category(', '); ?></span><time><?php the_time('Y-m-d'); ?></time>
				</div>
				<a href="<?php the_permalink(); ?>">
					<h2 class="list-title">
					<?php
						if(mb_strlen($post->post_title, 'UTF-8')>20){
							$title= mb_substr($post->post_title, 0, 20, 'UTF-8');
							echo $title.'……';
						}else{
							echo $post->post_title;
						}
					?>
					</h2>
					<p><?php echo mb_substr(strip_tags($post-> post_content),0,100). '...'; ?></p>
				</a>
			<?php else:　//それ以外のカテゴリでの表示 ?>
				<figure><?php the_post_thumbnail('page_eyecatch'); ?></figure>
				<div class="list-info">
					<span class="meta-category <?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->category_nicename";} ?>"><?php the_category(', '); ?></span><time><?php the_time('Y-m-d'); ?></time>
				</div>
				<h2 class="list-title"><a href="<?php the_permalink(); ?>">
				<?php
					if(mb_strlen($post->post_title, 'UTF-8')>20){
						$title= mb_substr($post->post_title, 0, 20, 'UTF-8');
						echo $title.'……';
					}else{
						echo $post->post_title;
					}
				?>
				</a></h2>
			<?php endif; ?>
		</article>
	<?php endwhile; endif; ?>
	</section>
	<aside>
		<h2 class="font-abc page-title">Topics News</h2>
		<ul>
			<?php
			$topics_home = new WP_Query('posts_per_page= 5&cat=5,4');
			if($topics_home-> have_posts()) :
				while($topics_home-> have_posts()) : $topics_home->the_post();
			?>
			<li>
				<div class="list-info" id="aside-info">
					<span class="meta-category <?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->category_nicename";} ?>"><?php the_category(', '); ?></span>
					<time><?php the_time('Y-m-d'); ?></time>
				</div>
				<a href="<?php the_permalink(); ?>">
				<p><?php the_title(); ?></p></a>
			</li>
		<?php endwhile; endif ; wp_reset_postdata(); ?>
		</ul>
	</aside>
	<aside class="snsbox">
		<div id="bloglist">
			<h2 class="font-abc page-title">Staff Blog</h2>
			<?php dynamic_sidebar('rss-list'); ?>
		</div>
		<div id="fblist">
			<h2 class="font-abc page-title">Facebook</h2>
			<?php dynamic_sidebar('fb-list'); ?>
		</div>
	</aside>
</div>
<?php get_footer(); ?>