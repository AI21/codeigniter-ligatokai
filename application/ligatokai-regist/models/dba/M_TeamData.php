<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * RarryInformation_Model
 *
 * author imai
 */
class M_TeamData extends MY_Model {

    // private $_rid   = NULL;

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

    }

    /*
     * 大会登録チーム情報の取得
     *
     * param    $p_intRid ： 大会ID
     * return 登録チーム情報
     *
     * since 20160118 imai 新規作成
     */
	public function getRegistTeam( $p_intRarryId, $p_intRarryClass = NULL ) {

        $aryData = NULL;
        $strSql = '';
        $arySqlBind = array();

        $strSql .= 'SELECT ';
        $strSql .= '    RT.class ';
        $strSql .= '    ,CI.block_name ';
        $strSql .= '    ,RT.t_id ';
        $strSql .= '    ,RT.team_name ';
        $strSql .= '    ,RT.abb_name ';
        $strSql .= 'FROM ';
        $strSql .= '    ' . D_REGIST_TEAM . ' RT ';
        $strSql .= 'LEFT JOIN ';
        $strSql .= '   ' . M_CLASS_INFO . ' CI ';
        $strSql .= '    ON RT.class = CI.id ';
        $strSql .= 'WHERE ';
        $strSql .= '    RT.r_id = ? ';
        // クラス指定あり
        if ( is_null( $p_intRarryClass ) === FALSE && $p_intRarryClass > 0 ) {
            $strSql .= '    RT.class = ? ';
        }
        $strSql .= 'ORDER BY ';
        $strSql .= '    CI.view_no ';
        $strSql .= '    ,RT.class ';
        $strSql .= '    ,RT.team_name ';
// print $strSql;
        // バインド設定
        $arySqlBind = array(
            $p_intRarryId,
        );
// var_dump($arySqlBind);
        // クラス指定あり
        if ( is_null( $p_intRarryClass ) === FALSE && $p_intRarryClass > 0 ) {
            $arySqlBind = array_push($p_intRarryId, $p_intRarryClass);
        }

        // SQLクエリ発行
        $query = $this -> db -> query( $strSql, $arySqlBind );

        // 結果取得
        if ( $query -> num_rows() > 0 ) {
            $aryData = $query -> result_array();
        }


        return $aryData;
    }


	/*
	 * チーム情報取得
	 *
	 * param    $p_strTeamId ： チームID
	 * return 登録チーム情報
	 *
	 * since 20170108 imai 新規作成
	 */
	public function getTeamRepresentData( $p_strTeamId ) {

		$aryData = NULL;
		$strSql = '';
		$arySqlBind = array();

		$strSql = '
			SELECT
				TI.represent
				,TI.represent_tel
				,TI.represent_address
				,CONCAT(TI.represent_mobile_address, MD.domain) AS represent_mobile_address
				,TI.sub_represent
				,TI.sub_represent_tel
				,TI.sub_represent_address
			FROM
				' . D_TEAM_INFO . ' TI 
			LEFT JOIN
				' . M_MOBILE_DOMAIN . ' MD
				ON TI.represent_mobile_domain = MD.id
			WHERE
				TI.id = ?
		';

		// バインド設定
		$arySqlBind = array(
			$p_strTeamId
		);

		// SQLクエリ発行
		$query = $this -> db -> query( $strSql, $arySqlBind );

		// 結果取得
		if ( $query -> num_rows() > 0 ) {
			$aryData = $query -> row_array();
		}

		return $aryData;
	}


	/*
	 * チーム登録チェック
	 *
	 * param    $p_strLoginId ： ログインID
	 * param    $p_strPassword ： パスワード
	 * return 登録チーム情報
	 *
	 * since 20160118 imai 新規作成
	 */
	public function chechTeamInfoData( $p_strLoginId, $p_strPassword ) {

		$aryData = NULL;
		$strSql = '';
		$arySqlBind = array();

		$strSql = '
			SELECT
				TI.id AS team_id
			FROM
				' . D_TEAM_INFO . ' TI 
			WHERE
				TI.login_id = ?
				AND TI.password = ?
		';

		// バインド設定
		$arySqlBind = array(
			$p_strLoginId,
			$p_strPassword
		);

		// SQLクエリ発行
		$query = $this -> db -> query( $strSql, $arySqlBind );

		// 結果取得
		if ( $query -> num_rows() > 0 ) {
			$aryData = $query -> row_array();
		}

		return $aryData;
	}


	/*
	 * 大会登録チーム情報の取得
	 *
	 * param    $p_intTeamId ： チームID
	 * return 登録チーム情報
	 *
	 * since 20160118 imai 新規作成
	 */
	public function getTeamRegistRarryData( $p_intTeamId ) {

		$aryData = NULL;
		$strSql = '';
		$arySqlBind = array();

		$strSql = "
			SELECT
				RI.id AS rarry_id
				,RI.rarry_name
				,RI.rarry_sub_name
			FROM
				" . D_REGIST_TEAM . " RT 
			LEFT JOIN
				" . D_RARRY_INFO . " RI 
				ON RT.r_id = RI.id
			WHERE
				RT.t_id = ?
				AND RI.finish_flg = 0
		";

		// バインド設定
		$arySqlBind = array(
			$p_intTeamId,
		);

		// SQLクエリ発行
		$query = $this -> db -> query( $strSql, $arySqlBind );

		// 結果取得
		if ( $query -> num_rows() > 0 ) {
			$aryData = $query -> result_array();
		}

		return $aryData;
	}

}

?>