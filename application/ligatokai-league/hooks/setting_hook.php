<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_hook {

	/*
	 * 独自設定ファイルの読み込み
	 *
	 *
	 *
	 */
    function load_setting() {

		// データべ−ステーブル設定ファイルを読み込み
		require_once ( APPPATH . 'config/database/db_setting.php');
		// キャッシュ設定ファイルを読み込み
		require_once ( APPPATH . 'config/define/cache.php');
		// 共通設定ファイルを読み込み
		require_once ( APPPATH . 'config/define/common.php');
		// 共通設定ファイルを読み込み
		require_once ( APPPATH . 'config/define/league.php');
//
//		$datas = 'QWERTYUYTREWQ';
//
//        return $datas;
    }
}
?>