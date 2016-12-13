<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Home extends MY_Controller {

	private $_aryLoadCss;
	private $_aryLoadJs;
	// private $_aryRarryData;
	// private $_aryRegistTaamData;
	// private $_strSessionRarryId;

	public function __construct() {
		parent::__construct();
		// ヘルパー設定
		$this->load->helper(
			array()
		);
		// CSS・Javascript設定
		$this -> _aryLoadCss = array();
		$this -> _aryLoadJs = array();

		// $this -> _strSessionRarryId = MAIN_RARRY_ID;
		//
		// $strSessionRarryId = $this->session->userdata('rarry_id');
		//
		// // 大会IDのセッションデータがある場合
		// if ( is_null($strSessionRarryId) === FALSE ) {
		// 	// 大会情報取得
		// 	$this -> aryRarryData = $this -> M_RarryInfoData -> getRarryData( $strSessionRarryId  );
		// 	// 大会登録チーム情報取得
		// 	$this -> aryRegistTeam = $this -> M_TeamData -> getRegistTeam( $strSessionRarryId  );
		//
		// 	$this -> _strSessionRarryId = $strSessionRarryId;
		// }

	}

	/**
	 * ホーム用のコントローラー
	 *
	 * サイトHOMEのページを表示します。
	 *
	 * $p_rid string 大会ID
	 *
	 * since 20160116 imai 新規作成
	 *
	 */
	public function index( $p_intRarryId = MAIN_RARRY_ID ) {

		$aryData = array();
		$aryMeta = array();
		$aryFooterLoadJs = array();

		// 大会情報取得
		$aryRarryData = $this -> M_Cache -> getCache( 'RarryData_' . $p_intRarryId, CACHE_1S );
		if( $aryRarryData === FALSE ) {
			$aryRarryData = $this -> M_RarryInfoData -> getRarryData( $p_intRarryId );
			// 結果をキャッシュに入れる
            $this -> M_Cache -> saveCache( 'RarryData_' . $p_intRarryId, $aryRarryData );
        }
	// 大会登録チーム情報取得
		$aryRegistTeam = $this -> M_Cache -> getCache( 'RegistTeam_' . $p_intRarryId, CACHE_1S );
		if( $aryRegistTeam === FALSE ) {
			$aryRegistTeam = $this -> M_TeamData -> getRegistTeam( $p_intRarryId );
			// 結果をキャッシュに入れる
            $this -> M_Cache -> saveCache( 'RegistTeam_' . $p_intRarryId, $aryRegistTeam );
        }

// 		if ( $p_intRarryId !== $this -> _strSessionRarryId ) {
// 			$arySessionData = array('rarry_id' => $p_intRarryId);
// var_dump($arySessionData);
// 			$this -> session -> set_userdata($arySessionData);
// 			// 大会情報取得
// 			$this -> aryRarryData = $this -> M_RarryInfoData -> getRarryData( $p_intRarryId );
// 			// 大会登録チーム情報取得
// 			$this -> aryRegistTeam = $this -> M_TeamData -> getRegistTeam( $p_intRarryId );
// 		}


// var_dump($aryRarryData);
// print nl2br(print_r($aryRegistTeam, 1));
// print $aryRarryData['rarry_sub_name'];

		// データをビューに渡す
		$aryData['aryMeta'] = $aryMeta;
		$aryData['loadCss'] = $this -> _aryLoadCss;
		$aryData['loadJs'] = $this -> _aryLoadJs;
		$aryData['aryFooterLoadJs'] = $aryFooterLoadJs;
		$aryData['intRarryId'] = $p_intRarryId;
		$aryData['aryRarryData'] = $aryRarryData;
		$aryData['aryRegistTeam'] = $aryRegistTeam;

		// ビューの指定
		$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
		$this -> load -> view( $this -> get_theme('V_Home'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
	}
}
