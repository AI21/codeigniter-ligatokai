<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Home extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

        // モデル設定
        $this->load->model(
            array()
        );
        // ヘルパー設定
        $this->load->helper(
            array()
        );
        // CSS・Javascript設定
        $this -> _aryLoadCss = array();
        $this -> _aryLoadJs = array();
    }

    function main( $p_intRarryId = MAIN_RARRY_ID ) {

        $retData = array();
        $aryMeta = array();
        $aryRarryData = array();
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
        $retData['aryMeta'] = $aryMeta;
        $retData['loadCss'] = $this -> _aryLoadCss;
        $retData['loadJs'] = $this -> _aryLoadJs;
        $retData['aryFooterLoadJs'] = $aryFooterLoadJs;
        $retData['intRarryId'] = $p_intRarryId;
        $retData['aryRarryData'] = $aryRarryData;
        $retData['aryRegistTeam'] = $aryRegistTeam;

        return $retData;
    }

}