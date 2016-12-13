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
		// モデル設定
		$this->load->model(
			array('M_Home', 'dba/M_RarryInfoData')
		);
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

//		$test;

		$aryData = $this -> M_Home -> main( $p_intRarryId );

		// ビューの指定
		$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
		$this -> load -> view( $this -> get_theme('V_Home'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
	}
}
