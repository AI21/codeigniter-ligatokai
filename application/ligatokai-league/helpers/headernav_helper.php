<?php
/**
 * HTMLヘッダーナビ用のヘルパー
 *
 * HTMLフッターを作成して返却
 *
 * @author	imai
 * @since	20160116 新規作成
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getHtmlHeaderNav'))
{
	/**
	 * Heading
	 *
	 * Generates an HTML heading tag.
	 *
	 * @param	string	content
	 * @param	int	heading level
	 * @param	string
	 * @return	string
	 */
	function getHtmlHeaderNav ( $p_intRarryId, $p_aryRegistTeam ) {

		$CI =& get_instance();

		$strHtmlNav = '';
		$aryRegistClassTeam = array();
		$aryRegistClassList = array();

        if ( count($p_aryRegistTeam) == 0 ) {
            return $strHtmlNav;
        }

		// $CI -> config -> item('base_url');

		// $list = array(
		// 	'HOME' => '<a href="/">HOME</a>',
		// 	'NEWS' => '<a href="/news/">NEWS</a>',
		// 	'TEAM' => $aryRegistClassTeamNaviList,
		// 	'RANKING' => $aryRegistClassRankingiList,
		// 	'試合結果' => '<a href="/result/">試合結果</a>',
		// 	'大会ルール' => '<a href="/rule/">大会ルール</a>',
		// 	'会場MAP' => '<a href="/map/">会場MAP</a>',
		// 	'お問い合わせ' => '<a href="/inquire/">お問い合わせ</a>',
		// 	'募集' => '<a href="/entry/">募集</a>',
        // );

		// リストのパラメータ設定
		$aryListFirstAttributes = array(
		    'class' => 'lv1',
		);
		$aryListSecondAttributes = array(
		    'class' => 'lv2',
		);
// print nl2br(print_r($p_aryRegistTeam, 1));

		// リンク用パラメータ
		// type ： 1:通常表示、2:リーグ戦のみ、3:トーナメントのみ
		$aryPageLink = array(
			array( 'type' => 1, 'season' => TRUE,  'title' => 'Home', 'url' => '' ),
			array( 'type' => 1, 'season' => FALSE, 'title' => 'News', 'url' => 'blog' ),
			array( 'type' => 1, 'season' => TRUE,  'title' => 'Schejule', 'url' => 'schejule' ),
			array( 'type' => 1, 'season' => TRUE,  'title' => 'Team', 'url' => 'team' ),
			array( 'type' => 2, 'season' => TRUE,  'title' => 'Ranking', 'url' => 'ranking' ),
			array( 'type' => 1, 'season' => TRUE,  'title' => 'Result', 'url' => 'result' ),
			array( 'type' => 1, 'season' => FALSE, 'title' => 'Rule', 'url' => 'rule' ),
			array( 'type' => 1, 'season' => FALSE, 'title' => 'Map', 'url' => 'map' ),
			array( 'type' => 1, 'season' => FALSE, 'title' => 'Inquiry', 'url' => 'inquiry' ),
			array( 'type' => 1, 'season' => FALSE, 'title' => 'Othor', 'url' => 'othor' ),
		);

		// ランキング用パラメータ
		$aryRankingList = array(
			array( 'indiPiusData' => FALSE, 'url' => 'ranking', 'urlSub' => 'team', 'urlSubDetail' => '', 'title' => 'チーム勝取表' ),
			array( 'indiPiusData' => FALSE, 'url' => 'ranking', 'urlSub' => 'table', 'urlSubDetail' => '', 'title' => 'チーム対戦表' ),
			array( 'indiPiusData' => FALSE, 'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => '', 'title' => '個人得点' ),
			array( 'indiPiusData' => FALSE, 'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => '3p', 'title' => '個人3ポイント' ),
			array( 'indiPiusData' => TRUE,  'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => 'rb', 'title' => '個人Rebound' ),
			array( 'indiPiusData' => TRUE,  'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => 'as', 'title' => '個人Assist' ),
			array( 'indiPiusData' => TRUE,  'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => 'st', 'title' => '個人Steal' ),
			array( 'indiPiusData' => TRUE,  'url' => 'ranking', 'urlSub' => 'indi', 'urlSubDetail' => 'bl', 'title' => '個人BlockShot' ),
		);

		$strSeason = ( $p_intRarryId !== '' ) ?  $p_intRarryId : MAIN_RARRY_ID ;

		$strHtmlNav .= '<nav id="headerNav">' . LF;
		$strHtmlNav .= '		<div class="inner">' . LF;
		$strHtmlNav .= '			<ul id="mainNav" class="navi">' . LF;
		for ( $i=0; $i<count($aryPageLink); $i++ ){

			$strUrl = ( $aryPageLink[$i]['season'] === TRUE ) ? $aryPageLink[$i]['url'] . '/' . $strSeason : $aryPageLink[$i]['url'];

			// チーム一覧
			if ( $aryPageLink[$i]['title'] === 'Home' ) {
				$strHtmlNav .= '				' . li( alink( $strSeason , $aryPageLink[$i]['title']), $aryListFirstAttributes ) . LF;
			// チーム一覧
			} elseif ( $aryPageLink[$i]['title'] === 'Team' ) {
				$breakClass = $p_aryRegistTeam[0]['class'];

				// チーム詳細ページのURL
				$strSubUrl = str_replace('team', 'team/detail', $strUrl);

				$aryRegistClassList[] = array( 'blockId' => $breakClass, 'blockName' => $p_aryRegistTeam[0]['block_name'] );
				$strHtmlNav .= '				<li class="teamList">' . LF;
				$strHtmlNav .= '					' . alink( $strUrl, $p_aryRegistTeam[0]['block_name'] ) . LF;
				$strHtmlNav .= '					<ul>' . LF;

				// チーム詳細ページへのリンク生成
				for ( $j = 0; $j < count($p_aryRegistTeam); $j++ ) {
					if ($breakClass !== $p_aryRegistTeam[$j]['class']) {
						// ランキング用
						$aryRegistClassList[] = array( 'blockId' => $p_aryRegistTeam[$j]['class'], 'blockName' => $p_aryRegistTeam[$j]['block_name'] );
						$strHtmlNav .= '					</ul>' . LF;
						$strHtmlNav .= '				</li>' . LF;
						$strHtmlNav .= '				<li>' . LF;
						$strHtmlNav .= '					' . alink( $strUrl . '/' . $p_aryRegistTeam[$j]['class'], $p_aryRegistTeam[$j]['block_name']) . LF;
						$strHtmlNav .= '					<ul>' . LF;
					}
					$strHtmlNav .= '						' . li( alink( $strSubUrl . '/' . $p_aryRegistTeam[$j]['t_id'], $p_aryRegistTeam[$j]['team_name'])) . LF;
					$breakClass = $p_aryRegistTeam[$j]['class'];
				}
				$strHtmlNav .= '					</ul>' . LF;
				$strHtmlNav .= '				</li>' . LF;
			// ランキング
			} elseif ( $aryPageLink[$i]['title'] === 'Ranking' ) {

				$strHtmlNav .= '				<li class="teamList">' . LF;
				$strHtmlNav .= '					' . alink( $strUrl, $aryPageLink[$i]['title'] ) . LF;
				$strHtmlNav .= '					<ul>' . LF;
				// 登録されている大会クラスのリンクを生成
				for ( $k = 0; $k<count($aryRegistClassList); $k++ ) {

					$strHtmlNav .= '					<li class="rankingList">' . LF;
					$strHtmlNav .= '						' . alink( $strUrl . '/' . $aryRegistClassList[$k]['blockId'], $aryRegistClassList[$k]['blockName'] ) . LF;
					$strHtmlNav .= '						<ul>' . LF;

					for ( $m = 0; $m < count($aryRankingList); $m++ ) {

						// ランキング詳細ページのURL
						$strSubUrl = str_replace($aryPageLink[$i]['url'], $aryRankingList[$m]['url'] , $strUrl);
						if ( $aryRankingList[$m]['urlSub'] !== '' ) {
							$strSubUrl = str_replace($aryPageLink[$i]['url'], $aryRankingList[$m]['url'] . '/' . $aryRankingList[$m]['urlSub'] , $strUrl);
						}
						$strSubUrl .= '/' . $aryRegistClassList[$k]['blockId'];
						// 個人スタッツの項目リンクがある場合
						if ( $aryRankingList[$m]['urlSubDetail'] !== '' ) {
							$strSubUrl .= '/' . $aryRankingList[$m]['urlSubDetail'];
						}

						// 1部以外で追加項目の個人スタッツはリンクしない
						if ( $aryRegistClassList[$k]['blockId'] !== '1' && $aryRankingList[$m]['indiPiusData'] === TRUE ) {
							continue;
						}
						$strHtmlNav .= '						' . li( alink( $strSubUrl, $aryRankingList[$m]['title'])) . LF;
					}
					$strHtmlNav .= '						</ul>' . LF;
					$strHtmlNav .= '					</li>' . LF;
				}
				$strHtmlNav .= '					</ul>' . LF;
				$strHtmlNav .= '				</li>' . LF;
			} else {
				$strHtmlNav .= '				' . li( alink( $strUrl , $aryPageLink[$i]['title']), $aryListFirstAttributes ) . LF;
			}
		}
		$strHtmlNav .= '			</ul>' . LF;
		$strHtmlNav .= '		</div>' . LF;
		$strHtmlNav .= '	</nav>' . LF;

		return $strHtmlNav;
	}
}

?>