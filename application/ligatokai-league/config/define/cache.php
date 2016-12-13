<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| キャッシュ設定ファイル
|--------------------------------------------------------------------------
*/

// キャッシュの時間設定（秒 * 分 * 時間 * 日にち）
define('CACHE_1Y', ( 60 * 60 * 24 * 365 ) );     // 1年
define('CACHE_6M', ( 60 * 60 * 24 * 180 ) );     // 180日（約6か月）
define('CACHE_3M', ( 60 * 60 * 24 * 90 ) );     // 90日（約3か月）
define('CACHE_2M', ( 60 * 60 * 24 * 60 ) );     // 60日（約2か月）
define('CACHE_1M', ( 60 * 60 * 24 * 30 ) );     // 30日（約1か月）
define('CACHE_20D', ( 60 * 60 * 24 * 20 ) );     // 20日
define('CACHE_15D', ( 60 * 60 * 24 * 15 ) );     // 15日
define('CACHE_10D', ( 60 * 60 * 24 * 10 ) );     // 10日
define('CACHE_5D', ( 60 * 60 * 24 * 5 ) );     // 5日
define('CACHE_3D', ( 60 * 60 * 24 * 3 ) );     // 3日
define('CACHE_2D', ( 60 * 60 * 24 * 2 ) );     // 2日
define('CACHE_1D', ( 60 * 60 * 24 ) );     // 1日
define('CACHE_12H', ( 60 * 60 * 12 ) );     // 12時間
define('CACHE_9H', ( 60 * 60 * 9 ) );     // 9時間
define('CACHE_6H', ( 60 * 60 * 6 ) );     // 6時間
define('CACHE_3H', ( 60 * 60 * 3 ) );     // 3時間
define('CACHE_2H', ( 60 * 60 * 2 ) );     // 2時間
define('CACHE_1H', ( 60 * 60 ) );     // 1時間
define('CACHE_30S', ( 1800 ) );     // 30分
define('CACHE_15S', ( 900 ) );     // 15分
define('CACHE_10S', ( 600 ) );     // 10分
define('CACHE_5S', ( 300 ) );     // 5分
define('CACHE_1S', ( 60 ) );     // 1分

