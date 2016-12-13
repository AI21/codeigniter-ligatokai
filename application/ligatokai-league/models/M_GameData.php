<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * M_GameData_Model
 *
 * 試合結果情報モデル
 *
 * author imai
 */
class M_GameData extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();
		// ライブラリ
		$this->load->library(
			array('define_parse')
		);
    }

    /*
     * 対戦節毎の試合結果情報の取得
     *
     * param    $p_intRarryId : 大会ID
     * param    $p_intClassId : クラス
     * param    $p_intSectionNo : 対戦節
     * return $aryData : 試合結果
     *
     * since 20160801 imai 新規作成
     */
	public function getSectionGameData( $p_intRarryId, $p_intClassId, $p_intSectionNo ) {

        $aryData = NULL;
        $strSql = '';
        $arySqlBind = array();

        $strSql = <<<EOF
            SELECT 
            	RCG.id AS game_id 
                ,DATE_FORMAT(RCG.times, '%Y年%m月%d日') AS game_day 
                ,MHI.h_name 
                ,RCG.home_team 
                ,RTH.team_name AS home_team_name 
                ,(RSH.1st + RSH.2nd + RSH.3rd + RSH.4th + RSH.ot1 + RSH.ot2 + RSH.ot3 + RSH.ot4 + RSH.ot5 + RSH.ot6 + RSH.ot7 + RSH.ot8 + RSH.ot9 ) AS score_home 
                ,RCG.away_team 
                ,RTA.team_name AS away_team_name 
                ,(RSA.1st + RSA.2nd + RSA.3rd + RSA.4th + RSA.ot1 + RSA.ot2 + RSA.ot3 + RSA.ot4 + RSA.ot5 + RSA.ot6 + RSA.ot7 + RSA.ot8 + RSA.ot9 ) AS score_away 
                ,RCG.importance 
            FROM {$this -> define_parse -> getDef('D_COMP_GAME')} RCG 
            LEFT JOIN {$this -> define_parse -> getDef('M_COAT_INFO')} MCI 
                ON RCG.court = MCI.id 
            LEFT JOIN {$this -> define_parse -> getDef('M_HALL_INFO')} MHI 
                ON MCI.hall_id = MHI.id 
            LEFT JOIN {$this -> define_parse -> getDef('D_RARRY_SCORE')} RSH 
                ON RCG.id = RSH.g_id 
                    AND RCG.home_team = RSH.t_id 
            LEFT JOIN {$this -> define_parse -> getDef('D_REGIST_TEAM')} RTH 
                ON RCG.r_id = RTH.r_id 
                    AND RSH.t_id = RTH.t_id 
            LEFT JOIN {$this -> define_parse -> getDef('D_RARRY_SCORE')} RSA 
                ON RCG.id = RSA.g_id 
                    AND RCG.away_team = RSA.t_id 
            LEFT JOIN {$this -> define_parse -> getDef('D_REGIST_TEAM')} RTA 
                ON RCG.r_id = RTA.r_id 
                    AND RSA.t_id = RTA.t_id 
            WHERE 
                RCG.r_id = ? 
                AND RCG.class = ? 
                AND RCG.section = ? 
            ORDER BY 
                RCG.times 
EOF;
//print $strSql;
        // バインド設定
        $arySqlBind = array(
            $p_intRarryId,
            $p_intClassId,
            $p_intSectionNo,
        );
//print nl2br(print_r($arySqlBind,1));

        // SQLクエリ発行
        $query = $this -> db -> query( $strSql, $arySqlBind );

        // 結果取得
        if ( $query -> num_rows() > 0 ) {
            foreach ($query->result_array() as $row) {
                $aryData[] = $row;
            }
        }

        return $aryData;
    }

}

?>