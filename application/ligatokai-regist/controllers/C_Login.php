<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends MY_Controller {

	private $_aryLoadCss;
	private $_aryLoadJs;

	public function __construct() {
		parent::__construct();
		// モデル設定
		$this->load->model(
			array('M_Login')
		);
		// ヘルパー設定
		$this->load->helper(
			array()
		);
		// CSS・Javascript設定
		$this -> _aryLoadCss = array('login', 'remodal', 'remodal-default-theme');
		$this -> _aryLoadJs = array('login', 'remodal.min');
	}

	/**
	 * ログインページ
	 *
	 * ログインページを表示します。
	 *
	 * since 20160116 imai 新規作成
	 *
	 */
	public function index() {

		$aryData 			= array();

		$aryData = $this -> M_Login -> main();

		// HTML設定
		$aryData['loadCss'] 			= $this -> _aryLoadCss;
		$aryData['loadJs'] 				= $this -> _aryLoadJs;

		// ビューの指定
		$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
		$this -> load -> view( $this -> get_theme('V_Login'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
	}


	/**
	 * Ajax：大会一覧取得
	 *
	 * チーム情報が修正できる大会一覧を返却します。
	 *
	 * since 20170101 imai 新規作成
	 *
	 */
	public function ajaxGetTeamRarryData() {

		$aryData 			= array();

		// 大会情報取得
		$aryData = $this -> M_Login -> getTeamRarryData();

		// JSONにして返却
		$this -> output -> set_content_type('application/json');
		$this -> output -> set_output(json_encode($aryData));
	}


	/**
	 * Ajax：チーム代表メールアドレス確認
	 *
	 * 代表者・服代表者のメールの整合性をチェックして結果を返却します。
	 *
	 * since 20170108 imai 新規作成
	 *
	 */
	public function ajaxCheckRepresentEmail() {

		$aryData 			= array();

		// 大会情報取得
		$aryData = $this -> M_Login -> checkRepresentEmail();

		// JSONにして返却
		$this -> output -> set_content_type('application/json');
		$this -> output -> set_output(json_encode($aryData));
	}

}
