<aside>
	<?php dynamic_sidebar('sidenavi-newlist'); ?>
	<p class="side-title font-abc">Archives</p>
	<ul>
	<?php wp_get_archives('limit=12'); ?>
	<?php wp_get_archives('type=yearly'); ?>
	</ul>
</aside>