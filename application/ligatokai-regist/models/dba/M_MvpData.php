<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * M_MvpData_Model
 *
 * author imai
 */
class M_MvpData extends MY_Model
{

	function __construct ()
	{
		// Model クラスのコンストラクタを呼び出す
		parent::__construct ();
		// ライブラリ
		$this->load->library(
			array('define_parse')
		);
	}

	/*
	 * 大会MVP情報の取得
	 *
	 * param    $p_intRarryId : 大会ID
	 * param    $p_intSectionNo : 対戦節
	 * return MUTCH DAY MVP情報
	 *
	 * since 20160801 imai 新規作成
	 */
	public function getMutchDayMvpData ( $p_intRarryId, $p_intSectionNo )
	{
		$aryData    = NULL;
		$strSql     = '';
		$arySqlBind = array ();

		$strSql = <<<EOF
			SELECT 
				MVPI.id AS mvp_id 
				,MVPI.goods_name 
				,MVPI.sponsor_view 
				,MSI.id AS s_id 
				,MSI.s_name 
				,CONCAT_WS('-', MSI.s_zip1, MSI.s_zip2) AS s_zip
				,MSI.s_prefecture 
				,MSI.s_city 
				,MSI.s_jusyo1 
				,MSI.s_jusyo2 
				,CONCAT_WS('-', MSI.s_tel1, MSI.s_tel2, MSI.s_tel3) AS s_tel
				,MSI.s_web1 
				,MSI.s_web2 
				,MSI.s_facebook 
				,MSI.s_twitter 
				,MSI.s_regular_day 
				,MSI.s_business_hours 
			FROM 
				{$this -> define_parse -> getDef('D_MVP_INFO')} MVPI 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_RARRY_INFO')} DRI 
			ON 
				MVPI.r_id = DRI.id 
			LEFT JOIN 
				{$this -> define_parse -> getDef('M_SPONSOR_INFO')} MSI 
			ON 
				MVPI.sponsor_id = MSI.id 
			WHERE 
				MVPI.r_id = ? 
				AND MVPI.section_no = ? 
EOF;

		// バインド設定
		$arySqlBind = array (
			$p_intRarryId,
			$p_intSectionNo,
		);

		// SQLクエリ発行
		$query = $this->db->query ( $strSql, $arySqlBind );
		// 結果取得
		if ( $query->num_rows () > 0 ) {
			$aryData = $query->row_array ();
		}

		return $aryData;
	}


	/*
	 * シーズン中のMVP情報一覧取得
	 *
	 * return MUTCH DAY MVP情報一覧
	 *
	 * since 20161127 imai 新規作成
	 */
	public function getSeasonMvpPublicList ()
	{
		$aryData    = NULL;
		$strSql     = '';
		$arySqlBind = array ();

		$strSql = <<<EOF
			SELECT  
				DRI.rarry_sub_name 
				,MVPI.r_id
				,MVPI.section_no 
			FROM 
				{$this -> define_parse -> getDef('D_MVP_INFO')} MVPI 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_RARRY_INFO')} DRI 
			ON 
				MVPI.r_id = DRI.id  
			WHERE 
				MVPI.public_flg = '1'
			ORDER BY
				DRI.id DESC
				,MVPI.section_no DESC
EOF;

		// バインド設定
		$arySqlBind = array ();

		// SQLクエリ発行
		$query = $this->db->query ( $strSql, $arySqlBind );
		// 結果取得
		if ( $query -> num_rows() > 0 ) {
			foreach ($query->result_array() as $row) {
				$aryData[] = $row;
			}
		}

		return $aryData;
	}


	/*
	 * MVP受賞選手情報の取得
	 *
	 * param    $p_intGameId : ゲームID
	 * param    $p_intPlayerId : MVPプレイヤーID
	 * return MVP候補選手一覧
	 *
	 * since 20160801 imai 新規作成
	 */
//	public function getMvpPlayerGameData ( $p_intGameId, $p_intPlayerId )
//	{
//		$aryData    = NULL;
//		$strSql     = '';
//		$arySqlBind = array ();
//
//		$strSql = <<<EOF
//			SELECT
//				DIS.3point_success
//				,DIS.2point_success
//				,DIS.ft_success
//				,DIS.assist
//				,DIS.of_rebound
//				,DIS.df_rebound
//				,DIS.steal
//				,DIS.block
//			FROM
//				{$this -> define_parse -> getDef('D_INDIVIDUAL_SCORE')} DIS
//			WHERE
//				DIS.game_id = ?
//				AND DIS.m_id = ?
//EOF;
//
//		// バインド設定
//		$arySqlBind = array (
//			$p_intGameId,
//			$p_intPlayerId,
//		);
//
//		// SQLクエリ発行
//		$query = $this -> db -> query( $strSql, $arySqlBind );
//
//		// 結果取得
//		if ( $query -> num_rows() > 0 ) {
//			$aryData = $query->row_array ();
//		}
//
//		return $aryData;
//	}


	/*
	 * MVP候補選手情報の取得
	 *
	 * param    $p_intMvpId : MVPデータID
	 * return MVP候補選手一覧
	 *
	 * since 20160801 imai 新規作成
	 */
	public function getMvpCandidatePlayers ( $p_intMvpId )
	{
		$aryData    = NULL;
		$strSql     = '';
		$arySqlBind = array ();

		$strSql = <<<EOF
			SELECT 
				DRT.t_id AS team_id 
				,DRT.team_name 
				,DTM.number 
				,DMP.player_id 
				,DMP.comment 
				,DMI.name_first
				,CONCAT_WS(' ', DMI.name_first, DMI.name_second) AS player_name
				,CONCAT_WS(' ', DMI.kana_first, DMI.kana_second) AS player_kana 
				,DMP.mvp_flg 
				,DMP.game_id 
				,IF (DIS.id, 1, 0) AS indi_flg
				,DIS.3point_success AS 3p_in
				,DIS.2point_success AS 2p_in 
				,DIS.ft_success AS ft_in 
				,DIS.assist  
				,DIS.of_rebound AS ofr 
				,DIS.df_rebound AS dfr 
				,DIS.steal 
				,DIS.block 
			FROM 
				{$this -> define_parse -> getDef('D_MVP_INFO')} MVPI 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_MVP_PLAYERS')} DMP 
			ON 
				MVPI.id = DMP.mvp_id 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_MEMBER_INFO')} DMI 
			ON 
				DMP.player_id = DMI.id 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_TEAM_MEMBER')} DTM 
			ON 
				MVPI.r_id = DTM.r_id 
				AND DTM.t_id = DTM.t_id 
				AND DMI.id = DTM.m_id 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_REGIST_TEAM')} DRT 
			ON 
				MVPI.r_id = DRT.r_id 
				AND DTM.t_id = DRT.t_id 
			LEFT JOIN 
				{$this -> define_parse -> getDef('D_INDIVIDUAL_SCORE')} DIS 
			ON 
				DMP.game_id = DIS.game_id 
				AND DMP.player_id = DIS.m_id 
			WHERE 
				DMP.mvp_id = ? 
			ORDER BY 
				DRT.t_id 
EOF;
//print $strSql;
		// バインド設定
		$arySqlBind = array (
			$p_intMvpId,
		);

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