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

}

?>