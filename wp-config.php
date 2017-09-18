<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wp-mowe');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', '');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',W~E4_D3{e-LhF0!jU(A2F5Bb=/vV-XC3=s-qV!p|NZ^6+0}]~apau`KT%w_s|O;');
define('SECURE_AUTH_KEY',  'na$6Ril8{VgIPxaVk$`%WdI/TiC|{3~DefnCT<p}YF)R*i:^bT,K,>)Q,FCm*IO7');
define('LOGGED_IN_KEY',    'LYjibe^~@6`MueGnFB?gltKM`)zu-ZiLmN_QZg>>&9:{fDz10#^^ct[x`AMO3}]Z');
define('NONCE_KEY',        'T;/V<:M;7,xj84W89QA)R!mSU8<:T3<KP4*X`R8d:4y)EIsg<E,~zY?4AV2d<p-R');
define('AUTH_SALT',        '~_*+x%|dHDMpNqp~O2+lBZ(2~.~><6>2d5@&k^5x5YSl0s@G{2%>fvlUSQu5M{up');
define('SECURE_AUTH_SALT', 'Wa99<8~Ed`Y*|$Q3^]:,JA3tX~qW9!Sjf{hFpgM^+?8+FKC;.uj)bzMF&&:3vZ(a');
define('LOGGED_IN_SALT',   'd@jO$O_+Qw_:)8%7KdC.`G*:]:Ibw.@0rNL+X)LxZ~`Wx.MK<LP+jT94z?(u72Yd');
define('NONCE_SALT',       'Y:Wy@xO2_[6+{2]2#: K/=NvVU9LYs>EbZkREKFz_eqtL2oM_(UHRbak]@gtA9zG');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
