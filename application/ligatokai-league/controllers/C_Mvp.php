<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MVP用のコントローラー
 *
 * MVPのページを表示します。
 *
 * since 20160730 imai 新規作成
 */
class C_Mvp extends MY_Controller {

	private $_aryLoadCss;
	private $_aryLoadJs;

	public function __construct() {
		parent::__construct();
		// モデル設定
		$this->load->model(
			array('M_Mvp', 'dba/M_MvpData', 'dba/M_GameData')
		);
		// ヘルパー設定
		$this->load->helper(
			array('url', 'file', 'header')
		);
		// CSS・Javascript設定
		$this -> _aryLoadCss = array('fillter', 'single', 'mvp', 'magnific-popup');
		$this -> _aryLoadJs = array('jquery.magnific-popup.min', 'mvp');
	}

	/**
	 * MVP用のコントローラー
	 *
	 * MVPのページを表示します。
	 *
	 * param integer $p_intRarryId : 大会ID
	 * param integer $p_intClassId : 対戦クラス
	 * param integer $p_intSectionNo : 対戦節
	 *
	 * since 20160116 imai 新規作成
	 */
	public function main( $p_intRarryId = MAIN_RARRY_ID ) {

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

		// データをビューに渡す
		$aryData['aryMeta'] = $aryMeta;
		$aryData['loadCss'] = $this -> _aryLoadCss;
		$aryData['loadJs'] = $this -> _aryLoadJs;
		$aryData['aryFooterLoadJs'] = $aryFooterLoadJs;
		$aryData['intRarryId'] = $p_intRarryId;
		$aryData['aryRarryData'] = $aryRarryData;
		$aryData['aryRegistTeam'] = $aryRegistTeam;

		// ビューの指定
		$this -> load -> view( $this -> get_theme('V_MvpMain'), $aryData );
	}

	/**
	 * MVP用のコントローラー
	 *
	 * MVPのページを表示します。
	 *
	 * param integer $p_intRarryId : 大会ID
	 * param integer $p_intClassId : 対戦クラス
	 * param integer $p_intSectionNo : 対戦節
	 *
	 * since 20160116 imai 新規作成
	 */
	public function index( $p_intRarryId = MAIN_RARRY_ID, $p_intClassId, $p_intSectionNo ) {

		$aryData 				= array();
		$aryMeta 				= array();
		$aryFooterLoadJs 		= array();

		// ビュー設定
		$strView = 'V_Mvp';

		// MVPデータ取得
		$aryData = $this -> M_Mvp -> getMvpDetail( $p_intRarryId, $p_intClassId, $p_intSectionNo );
		if ( empty($aryData) == TRUE ) {
			print 'NG';
			$strView = 'errors/error_Mvp';
//			exit;
		}

		// HTML設定
		$aryData['aryMeta'] 				= $aryMeta;
		$aryData['loadCss'] 				= $this -> _aryLoadCss;
		$aryData['loadJs'] 					= $this -> _aryLoadJs;
		$aryData['aryFooterLoadJs'] 		= $aryFooterLoadJs;

		// ビューの指定
		$this -> load -> view( $this -> get_theme(LAYOUT_PATH . LAYOUT_HTML_HEADER), $aryData );
		$this -> load -> view( $this -> get_theme($strView), $aryData );
		$this -> load -> view( $this -> get_theme(LAYOUT_PATH . LAYOUT_HTML_FOOTER), $aryData );
	}

}
