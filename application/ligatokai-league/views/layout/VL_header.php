<?php

$CI =& get_instance();

$strHtmlNav = '';
$aryRegistClassTeam = array();
$aryRegistClassTeamNaviList = array();
$aryRegistClassRankingiList = array();
$strClassName = '';

// 大会に所属するチームを処理
if ( isset($aryRegistTeam) == TRUE && count ($aryRegistTeam) > 0 ) {
	$strRegistBlockName = $aryRegistTeam[0]['block_name'];
	foreach ( $aryRegistTeam as $i => $aryTeamData ) {
		// クラス名が違う場合
		if ( $strRegistBlockName === $aryTeamData['block_name'] ) {
			// クラス毎のチーム情報の配列を生成
			$strClassName = $aryTeamData['block_name'];
			$aryRegistClass = $strClassName;
			$aryRegistClassTeam[$strClassName][] = $aryTeamData;
			// チーム一覧用のリンクを設定
			$aryRegistClassTeamNaviList[$strClassName][] = '<a href="' . $CI->config->item('base_url') . 'team/' . $intRarryId . '/' . $aryTeamData['t_id'] . '">' .$aryTeamData['team_name'] . '</a>';
			// ランキング用のリンクを設定
			$aryRegistClassRankingiList[$strClassName] = array(
				'<a href="/league/ranking/team/' . $intRarryId . '/' . $aryTeamData['class'] . '/">チーム勝取表</a>',
				'<a href="/league/versus/index/' . $intRarryId . '/' . $aryTeamData['class'] . '/">チーム勝取表</a>',
				'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/">個人得点</a>',
				'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/3p/">個人3ポイント</a>',
			);
			// 1部のみスタッツ項目を追加
			if ( $aryTeamData['class'] == '1' ) {
				array_push($aryRegistClassRankingiList[$strClassName],
					'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/rb/">個人Rebound</a>',
					'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/as/">個人Assist</a>',
					'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/st/">個人Steal</a>',
					'<a href="/league/ranking/indi/' . $intRarryId . '/' . $aryTeamData['class'] . '/bs/">個人BlockShot</a>'
				);
			}
		}
		$strRegistBlockName = $aryTeamData['block_name'];
	}
}
// print nl2br(print_r($aryRegistClassTeamNaviList, 1));

// リストのパラメータ設定
$attributes = array(
	'id'    => 'mainNav',
    'class' => 'navi',
    'roll' => 'navi',
);

$list = array(
	'HOME' => '<a href="/">HOME</a>',
	'NEWS' => '<a href="/news/">NEWS</a>',
	'TEAM' => $aryRegistClassTeamNaviList,
	'RANKING' => $aryRegistClassRankingiList,
	'試合結果' => '<a href="/result/">試合結果</a>',
	'大会ルール' => '<a href="/rule/">大会ルール</a>',
	'会場MAP' => '<a href="/map/">会場MAP</a>',
	'お問い合わせ' => '<a href="/inquire/">お問い合わせ</a>',
	'募集' => '<a href="/entry/">募集</a>',
);


// $strHtmlNav .= '		<header>' . LF;
// $strHtmlNav .= '			<div id="headerNav" class="inner">' . LF;
// $strHtmlNav .= '				<nav>' . LF;
// $strHtmlNav .= 						ul($list, $attributes, 5);
// $strHtmlNav .= '				</nav>' . LF;
// $strHtmlNav .= '			</div>' . LF;
// $strHtmlNav .= '		</header>' . LF;

getHtmlHeaderNav($intRarryId, $aryRegistTeam);

// echo $strHtmlNav;

?>