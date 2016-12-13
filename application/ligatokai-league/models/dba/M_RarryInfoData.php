<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * RarryInformation_Model
 *
 * author imai
 */
class M_RarryInfoData extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

    }

    /*
     * 大会情報の取得
     *
     * param    $p_rid ： 大会ID
     * return 大会情報
     *
     * since 20160118 imai 新規作成
     */
	public function getRarryData($p_intRarryId) {

        $aryData = NULL;
        $strSql = '';
        $arySqlBind = array();

        $strSql .= 'SELECT ';
        $strSql .= '    r.rarry_name ';
        $strSql .= '    ,r.rarry_sub_name ';
        $strSql .= '    ,r.season ';
        $strSql .= '    ,r.type ';
        $strSql .= '    ,r.parent_id ';
        $strSql .= '    ,r.progress ';
        $strSql .= 'FROM ';
        $strSql .= '    ' . D_RARRY_INFO . ' r ';
        $strSql .= 'WHERE ';
        $strSql .= '    r.id = ? ';

        // バインド設定
        $arySqlBind = array(
            $p_intRarryId,
        );

        // SQLクエリ発行
        $query = $this -> db -> query( $strSql, $arySqlBind );

        // 結果取得
        if ( $query -> num_rows() > 0 ) {
            $aryData = $query -> row_array();
        }

        return $aryData;
    }

}

?>