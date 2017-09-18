<?php
register_nav_menus(
	array(
	'head_navi' => 'ヘッダーナビ',
	)
);
/*
ウィジェット
*/
if(function_exists('register_sidebar')) {
register_sidebar(
	array(
		'id' =>'sidenavi-newlist',
		'name' =>'sidenavi-newlist',
		'before_widget' => '<div >',
		'after_widget' => '</div>',
		'before_title' => '<p class="side-title font-abc">',
		'after_title' => '</p>'
		));
register_sidebar(
	array(
		'id' =>'rss-list',
		'name' =>'rss-list',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<p>',
		'after_title' => '</p>'
		));
register_sidebar(
	array(
		'id' =>'fb-list',
		'name' =>'fb-list',
		'before_widget' => '<div id="bloglist">',
		'after_widget' => '</div>',
		'before_title' => '<p>',
		'after_title' => '</p>'
		));
register_sidebar(
	array(
		'id' =>'topbanner',
		'name' =>'topbanner',
		'before_widget' => '<div class="mainimages">',
		'after_widget' => '</div>',
		'before_title' => '<p>',
		'after_title' => '</p>'
		));
}
/*ウィジェットのタイトルを!で消去*/
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else
		return ( $widget_title );
}
/*
アイキャッチの表示
*/
add_theme_support('post-thumbnails');
/*
アイキャッチ画像の定義と切り抜き
*/
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
 add_image_size('new_list', 450, 323 ,true );
 add_image_size('page_eyecatch', 300, 215, true );
 add_image_size('post_eyecatch', 700, 466, true );
 add_image_size('topbig_banner', 980, 413, true );
}
/*
管理画面の投稿記事一覧にアイキャッチ画像を表示
*/
function manage_posts_columns($columns) {
		$columns['thumbnail'] = __('Thumbnail');
		return $columns;
}
function add_column($column_name, $post_id) {
	if ( 'thumbnail' == $column_name) {
			$thum = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
	}
	if ( isset($thum) && $thum ) {
			echo $thum;
	} elseif( esc_attr(get_post_meta($post_id, 'eye', true)) ) {
			echo '<img src="';
			echo esc_attr(get_post_meta($post_id, 'eye', true));
			echo '" width="50" height="50" alt="アイキャッチ画像" class="wp-post-image">';
	} else {
			echo '<span style="font-size:1.5em;color:red;font-weight:bold">';
			echo __('None');
			echo '</span>';
	}
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );

/*
パンくずリスト
*/
function breadcrumb(){
	global $post;
	$str ='';
	if(!is_home()&&!is_admin()){ /* !is_admin は管理ページ以外という条件分岐 */
		$str.= '<div id="breadcrumb">';
		$str.= '<ul>';
		$str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url('/') .'" class="home" itemprop="url" ><span itemprop="title">HOME</span></a> &gt;&#160;</li>';

		/* 投稿のページ */
		if(is_single()){
			$categories = get_the_category($post->ID);
			$cat = $categories[0];
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'"  itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor). '</span></a> &gt;&#160;</li>';
									}
			}
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span itemprop="title">'. $cat-> cat_name . '</span></a> &gt;&#160;</li>';
			$str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
		}

		/* 固定ページ */
		elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url" ><span itemprop="title">'. get_the_title($ancestor) .'</span></a> &gt;&#160;</li>';
									}
			}
			$str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
		}

		/* カテゴリページ */
		elseif(is_category()) {
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor) .'</span></a> &gt;&#160;</li>';
				}
			}
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat -> name . '</span></li>';
		}

		/* タグページ */
		elseif(is_tag()){
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. single_tag_title( '' , false ). '</span></li>';
		}

		/* 時系列アーカイブページ */
		elseif(is_date()){
			if(get_query_var('day') != 0){
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '" itemprop="url" ><span itemprop="title">' . get_query_var('year'). '年</span></a> &gt;&#160;</li>';
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url" ><span itemprop="title">'. get_query_var('monthnum') .'月</span></a> &gt;&#160;</li>';
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('day'). '</span>日</li>';
			} elseif(get_query_var('monthnum') != 0){
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')) .'" itemprop="url" ><span itemprop="title">'. get_query_var('year') .'年</span></a> &gt;&#160;</li>';
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('monthnum'). '</span>月</li>';
			} else {
				$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('year') .'年</span></li>';
			}
		}

		/* 投稿者ページ */
		elseif(is_author()){
			$str .='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
		}

		/* 添付ファイルページ */
		elseif(is_attachment()){
			if($post -> post_parent != 0 ){
				$str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($post -> post_parent).'" itemprop="url" ><span itemprop="title">'. get_the_title($post -> post_parent) .'</span></a> &gt;&#160;</li>';
			}
			$str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post -> post_title . '</span></li>';
		}

		/* 検索結果ページ */
		/*elseif(is_search()){
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
		}*/

		/* 404 Not Found ページ */
		elseif(is_404()){
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">お探しの記事は見つかりませんでした。</span></li>';
		}

		/* その他のページ */
		else{
			$str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. wp_title('', false) .'</span></li>';
		}
		$str.='</ul>';
		$str.='</div>';
	}
	echo $str;
}
/*
バージョン更新を非表示にする
*/
add_filter('pre_site_transient_update_core', '__return_zero');
// APIによるバージョンチェックの通信をさせない
remove_action('wp_version_check', 'wp_version_check');
remove_action('admin_init', '_maybe_update_core');
// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
 if (!current_user_can('level_10')) { //level10以下のユーザーの場合ウィジェットをunsetする
 global $wp_meta_boxes;
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
 unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
 }
 }
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');
/*
「投稿」を「記事を投稿する」、
「固定ページ」を「固定のページ」に変更
*/
function edit_admin_menus() {
	global $menu;
	$menu[5][0] = '記事を投稿する';    // 投稿
	$menu[20][0]  = '固定のページ';    // 固定ページ
}
add_action( 'admin_menu', 'edit_admin_menus' );
/*
　管理メニューに「操作マニュアル」ページを追加
*/
function page_manual() {
?>
<div class="wrapper">
		<h1>記事の投稿について</h1>
		<p>記事投稿についてのマニュアルです。</p>
		<h2>記事の作成方法</h2>
		<p>メニューの「記事を投稿する」から新規追加にて作成。</p>
		<p>タイトルがそのままリストに表示される際に、ページへのリンクになります。</p>
		<p>テキストエディタのテキストにて基本作成してください。<br>「link」はそのまま外部サイトおリンクを記述するときに使って下さい。<br>「img」は画像の挿入の時に使いますが、「メディアを追加」ボタンから直観的に画像を挿入できるので、ここからやった方が分かりやすいと思います。新しい画像を追加するときにもここから追加して挿入できます。<br>「見出し」は記事中に小見出しを入れる時に使って下さい。</p>
		<h2>投稿する時のカテゴリについて</h2>
		<P>記事投稿の際には必ずカテゴリを指定してください。</p>
		<p>投稿画面右側にカテゴリーの欄があるので、これよりチェックボックスにて指定してから、公開して下さい。</p>
		<p>※各カテゴリにはカラーを指定しています。カテゴリを追加するときには、注意してください。</p>
		<p>【カテゴリ説明】</p>
		<p>・EventNews <br>イベントの告知用。アイキャッチは無しで文章のみで投稿してください。※アイキャッチを設定してもリストでは画像は表示されません。<br>イベントの開始や終了のお知らせや予定告知などの画像がなくても伝わる記事を投稿するために使って下さい。</p>
		<p>・Event <br>イベントの詳細投稿用。EventNewsで告知した内容の詳細を投稿したり、イベントでの出来事などの投稿で使って下さい。</p>
		<p>・Information <br>お店の休みやセールなどの告知などで使って下さい。※アイキャッチは設定していてもリストでは表示されません。</p>
		<p>・New Item <br>新商品の紹介などで使用してください。</p>
		<p>・Other <br>サイト内のインフォメーション(ブログ更新やサイト更新など)やその他カテゴリに当てはまらない
		告知やお知らせなどで使用してください。</p>
		<h2>【アイキャッチについて】</h2>
		<p>アイキャッチを設定すると、リストで表示されたり、記事の一番上に大きな画像が表示されるようになります。</p>
		<p>アイキャッチはカテゴリによっては、リストでは表示されないようになりますので、注意してください。※記事ページでは表示されます。</p>
		<p>【アイキャッチの設定の仕方】</p>
		<p>投稿ページの右下へアイキャッチ画像という欄があるので、「アイキャッチ画像を設定」をクリックすると、メディアの表示になります。「ファイルをアップロード」をクリックし、追加したい画像ファイルをそのままドロップすれば、メディアへ追加できます。</p>
		<p>新規に画像を追加したときは、必ず「タイトル」「代替テキスト」を記入してください。※画像の説明になるような文字列が好ましいです。</p>
		<p>「アイキャッチ画像を設定する」をクリックすると、投稿画面に戻るので、設定した画像を確認し、投稿ボタンを押すと反映されます。</p>
</div>
<?php
}
function page_manual_sub1() {
?>
<div class="wrapper">
 <h1>トップのバナー画像について</h1>
 <p>indexページのトップバナーは、管理画面左サイドの「外観」よりウィジェットから変更可能です。</p>
 <p>画像の大きさは最大 980×413の大きさです。画像を作成するときは参考にして下さい。</p>
 <h2>トップバナーの変更の仕方</h2>
 <p>管理画面左サイドの「外観」よりウィジェットをクリックし、ウィジェット設定画面を開きます。<br>その中に「topbanner」というバナーがあるので、それをクリックすると、「Image Widget」という項目があるので、それをクリックすると、画像を変更出来る表が出てきます。<br>「select an image」をクリックするとメディアが出てくるので、アイキャッチと同じように画像を追加し、変更します。<br>titleに文字を入れるとバナーの上に表示されてしまうので、今回は無記入にして下さい。その代わりAlternate Textへ記入をして下さい。</p>
 <p>保存を押すと反映されます。</p>

</div>
<?php
}
function page_manuals () {
 add_menu_page('操作マニュアル', '操作マニュアル', 'manage_options', 'manual', 'page_manual');
  add_submenu_page('manual', 'トップバナーについて', 'トップバナーについて', 'manage_options', 'page_manual_sub1', 'page_manual_sub1');
}
add_action ( 'admin_menu', 'page_manuals' );
/*
	管理画面のメニュー背景を変更
*/
function my_head() {
?>
<style type="text/css">
#menu-posts {
	background: #e74c3c;
}
#toplevel_page_manual {
	background: #5e8ac5;
}
#menu-posts div.wp-menu-image:before,
#menu-posts div.wp-menu-name {
	color: #fff;
}
</style>
<?php
}
add_action ( 'admin_head', 'my_head', 11 );
/*
テキストエディタのボタンを削除
*/
function default_quicktags($qtInit) {
$qtInit['buttons'] = 'img,link';//表示するボタンのIDを羅列
return $qtInit;
}
add_filter('quicktags_settings', 'default_quicktags', 10, 1);
/*
テキストエディタにボタン追加
*/
if ( !function_exists( 'add_quicktags_to_text_editor' ) ):
function add_quicktags_to_text_editor() {
	if (wp_script_is('quicktags')){?>
		<script>
			QTags.addButton('bt-h2','見出し','<h2 class="font-abc ps-page-title">','</h2>');
		</script>
	<?php
	}
}
endif;
add_action( 'admin_print_footer_scripts', 'add_quicktags_to_text_editor' );
?>