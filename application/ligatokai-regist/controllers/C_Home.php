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

		$aryData = $this -> M_Home -> main( $p_intRarryId );

		// ビューの指定
		$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
		$this -> load -> view( $this -> get_theme('V_Home'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
	}
}
