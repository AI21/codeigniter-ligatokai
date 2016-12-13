<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| 共通設定
|--------------------------------------------------------------------------
*/

define('URL_SNS_TWITTER', 		'https://twitter.com/');			// Twitter
define('URL_SNS_FACEBOOK', 		'https://www.facebook.com/');		// Facebook
define('URL_SNS_INSTAGRAM', 	'https://www.instagram.com/');		// Instagram

define('COMMON_DIR_IMAGE', 		'/common/image/');			// イメージファイルがあるディレクトリ

// 本番サーバーとローカルでの違いがあるもの
if ( $_SERVER['SERVER_ADDR'] == '112.78.117.114' ) {
	define('SPONSOR_IMG_PATH', 			'../');			// 協賛店舗の画像のパス
	define('MVP_GOODS_IMG_PATH', 		'../');			// MVPの商品画像のパス
	define('LEAGUE_DIR_MVP', 			'/league/mvp/mvp/');		// MVPページディレクトリ
} else {
	define('SPONSOR_IMG_PATH', 			'.');			// 協賛店舗の画像のパス
	define('MVP_GOODS_IMG_PATH', 		'.');			// MVPの商品画像のパス
	define('LEAGUE_DIR_MVP', 			'/league/mvp/');		// MVPページディレクトリ
}

// レイアウトビュー
define('LAYOUT_PATH', 			'layout/');				// HTMLレイアウトフォルダ名
define('LAYOUT_HTML_HEADER', 	'VL_html5Head');		// HTMLヘッダーファイル
define('LAYOUT_HTML_FOOTER', 	'VL_htmlFooter');		// HTMLフッターファイル