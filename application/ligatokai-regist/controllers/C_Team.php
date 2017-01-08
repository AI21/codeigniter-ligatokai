<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Team extends MY_Controller {

	// $_aryLoadCss;
	// $_aryLoadJs;

	public function __construct() {
		parent::__construct();
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
	 * since 20160116 imai 新規作成
	 *
	 */
	public function index( $p_intRarryId = MAIN_RARRY_ID ) {

print $p_intRarryId." = TEAM";

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
		$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
		$this -> load -> view( $this -> get_theme('V_Home'), $aryData );
		$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
	}

		/**
		 * ホーム用のコントローラー
		 *
		 * サイトHOMEのページを表示します。
		 *
		 * since 20160116 imai 新規作成
		 *
		 */
		public function detail( $p_intRarryId = MAIN_RARRY_ID, $_intTeamid ) {

print $p_intRarryId." = TEAM/detail";
print $_intTeamid." = Teamid";

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
			$this -> load -> view( $this -> get_theme('layout/VL_html5Head'), $aryData );
			$this -> load -> view( $this -> get_theme('layout/VL_header'), $aryData );
			$this -> load -> view( $this -> get_theme('V_Home'), $aryData );
			$this -> load -> view( $this -> get_theme('layout/VL_htmlFooter'), $aryData );
		}
}
