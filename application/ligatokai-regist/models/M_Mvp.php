<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Mvp extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();
    }

    function getMvpDetail( $p_intRarryId, $p_intClassId, $p_intSectionNo ) {

        $retData                = array();
        $aryRegistTeam 			= array();
        $aryMvpData 			= array();
        $aryMvpPublicList		= array();
        $arySectionGameData 	= array();
        $aryMvpPlayerGameData	= array();
        $aryMvpCandidatePlayers	= array();
        $strGameDay 			= '';
        $strGameHall 			= '';
        $intMvpPlayerGameId 	= 0;
        $intMvpPlayerTeamId 	= 0;
        $aryMvpPlayevrData 		= array(
            'player_id',
            'player_name',
            'player_kana',
            'team_id',
            'team_name',
            'player_no',
            'score',
            'statz',
        );
        $arySponsor 			= array(
            'shop_id',
            'shop_name',
            'shop_data',
            'picture_01',
            'picture_02',
        );
        $strSponsorNoImage 		= base_url () . HTTP_DIR_IMAGE . "sponsor/" . SPONSOR_NO_IMAGE;
        $strPlayerNoImage 		= base_url () . HTTP_DIR_IMAGE . "team/" . PLAYER_NO_IMAGE;

        $strErrorMessage 		= 'ERROR';
        $strStatusCode 			= '500';
        $strHeading 			= 'qwerty';

        if ( $p_intSectionNo == '') {
            print "NG";
        }

        try {

			// 大会情報をキャッシュから取得、データがない場合はDB取得
			$aryRarryData= $this -> M_Cache -> getCache( 'RarryData_' . $p_intRarryId, CACHE_1S );
			if( $aryRarryData === FALSE ) {
				$aryRarryData = $this -> M_RarryInfoData -> getRarryData( $p_intRarryId );
				// 結果をキャッシュに入れる
				$this -> M_Cache -> saveCache( 'RarryData_' . $p_intRarryId, $aryRarryData );
			}
//print nl2br(print_r($aryRarryData,1));

			// MVP一覧情報をキャッシュから取得、データがない場合はDB取得
			$aryMvpPublicList = $this -> M_Cache -> getCache( 'MvpPublicList', CACHE_1S );
			if( $aryMvpPublicList === FALSE ) {
				$aryMvpPublicList = $this -> M_MvpData -> getSeasonMvpPublicList();
				// 結果をキャッシュに入れる
				$this -> M_Cache -> saveCache( 'MvpData', $aryMvpPublicList );
			}
//print nl2br(print_r($aryMvpPublicList,1));

			// MVP情報取得
			$aryMvpData = $this -> M_Cache -> getCache( 'MvpData_' . $p_intRarryId . '_' . $p_intSectionNo, CACHE_1S );
			if( $aryMvpData === FALSE ) {
				$aryMvpData = $this -> M_MvpData -> getMutchDayMvpData( $p_intRarryId, $p_intSectionNo );
				// 結果をキャッシュに入れる
				$this -> M_Cache -> saveCache( 'MvpData_' . $p_intRarryId . '_' . $p_intSectionNo, $aryMvpData );
			}
//print nl2br(print_r($aryMvpData,1));

			if ( count($aryMvpData) > 0 ) {
				// スポンサー情報：店舗ID
				if ( $aryMvpData['s_id'] != '' ) {
					$arySponsor['shop_id'] = $aryMvpData['s_id'];
				}
				// スポンサー情報：店舗名
				if ( $aryMvpData['s_name'] != '' ) {
					$arySponsor['shop_name'] = $aryMvpData['s_name'];
				}
				// スポンサー情報：表示名
				if ( $aryMvpData['sponsor_view'] != '' ) {
					$arySponsor['sponsor_view'] = $aryMvpData['sponsor_view'];
				}
				// 店舗情報[住所]
				if ( $aryMvpData['s_city'] != '' && $aryMvpData['s_jusyo1'] != '' ) {
					$strJusyo = $aryMvpData['s_jusyo1'];
					if ( empty($aryMvpData['s_jusyo2']) == FALSE ) {
						$strJusyo .= '<span class="jusyoSecond">' . $aryMvpData['s_jusyo2'] . '</span>';
					}
					$arySponsor['shop_data']['jusyo'] = array (
						'key' => '住所',
						'val' => $aryMvpData['s_city'] . $strJusyo
					);
				}
				// スポンサー情報：店舗情報[TEL]
				if ( $aryMvpData['s_tel'] != '' ) {
					$arySponsor['shop_data']['tel'] = array (
						'key' => 'TEL',
						'val' => $aryMvpData['s_tel']
					);
				}
				// スポンサー情報：店舗情報[営業時間]
				if ( $aryMvpData['s_business_hours'] != '' ) {
					$arySponsor['shop_data']['business_hours'] = array (
						'key' => '営業時間',
						'val' => $aryMvpData['s_business_hours']
					);
				}
				// スポンサー情報：店舗情報[定休日]
				if ( $aryMvpData['s_regular_day'] != '' ) {
					$arySponsor['shop_data']['regular_day'] = array (
						'key' => '定休日',
						'val' => $aryMvpData['s_regular_day']
					);
				}
				// スポンサー情報：店舗情報[HP]
				if ( $aryMvpData['s_web1'] != '' ) {
					$arySponsor['shop_sns']['homepage'] = array (
						'key'  => 'website',
						'link' => $aryMvpData['s_web1'],
						'val'  => 'Homepage',
					);
				}
				// スポンサー情報：店舗情報[Facebook]
				if ( $aryMvpData['s_facebook'] != '' ) {
					$arySponsor['shop_sns']['facebook'] = array (
						'key'  => 'facebook',
						'link' => URL_SNS_FACEBOOK . $aryMvpData['s_facebook'],
						'val'  => 'Facebook',
					);
				}
				// スポンサー情報：店舗情報[Twitter]
				if ( $aryMvpData['s_twitter'] != '' ) {
					$arySponsor['shop_sns']['twitter'] = array (
						'key'  => 'twitter',
						'link' => URL_SNS_TWITTER . $aryMvpData['s_twitter'],
						'val'  => 'Twitter',
					);
				}

				// ディレクトリのファイル情報を取得
				$strShopFilesInfo = get_dir_file_info ( SPONSOR_IMG_PATH );

				// スポンサー情報：店舗写真
				for ( $i = 0; $i < 2; $i++ ) {
					$arySponsorImageProperties = array (
						'src'   => $strSponsorNoImage,
						'alt'   => $aryMvpData['s_name'] . sprintf ( "%02d", ( $i + 1 ) ),
						'width' => '180',
					);
					// スポンサー写真を検索
					$strSponsorImageSrc  = '/image/sponsor/' . $arySponsor['shop_id'] . '/img' . sprintf ( "%02d", ( $i + 1 ) ) . '.jpg';
					$strSponsorImagePath = $strShopFilesInfo['common']['server_path'] . $strSponsorImageSrc;
					if ( file_exists ( $strSponsorImagePath ) == TRUE ) {
						$arySponsorImageProperties['src'] = 'common' . $strSponsorImageSrc;
					}
					$arySponsor['shop_img'][$i]['img'] = img ( $arySponsorImageProperties );
					$arySponsor['shop_img'][$i]['src'] ='/league/common' . $strSponsorImageSrc;
				}
				// 提供商品
				if ( $aryMvpData['goods_name'] != '' ) {
					$arySponsor['goods_name'] = $aryMvpData['goods_name'];
					// ディレクトリのファイル情報を取得
					$files_info = get_dir_file_info ( MVP_GOODS_IMG_PATH );
//print nl2br(print_r($files_info,1));
					// 提供写真の確認
					if ( isset( $files_info['common']['server_path'] ) == TRUE ) {
						$strGoodsImageUrl  = '/image/mvp/' . $p_intRarryId . '/' . $p_intClassId . '/' . $p_intSectionNo . '/' . 'goods.jpg';
						$strGoodsPhotoPath = $files_info['common']['server_path'] . $strGoodsImageUrl;
						if ( file_exists ( $strGoodsPhotoPath ) == TRUE ) {
							$arySponsor['goods_image'] = '/league/common' . $strGoodsImageUrl;
						}
					}

	//				$strGoodsPhotoPath = '/league/common/image/mvp/' . $p_intRarryId . '/' . $p_intClassId . '/' . $p_intSectionNo . '/' . 'goods.jpg';
				}
				// MVP候補選手の情報を取得
				$aryMvpCandidatePlayers = $this->M_Cache->getCache ( 'MvpCandidatePlayers_' . $aryMvpData['mvp_id'], CACHE_1S );
				if ( $aryMvpCandidatePlayers === FALSE ) {
					$aryMvpCandidatePlayers = $this->M_MvpData->getMvpCandidatePlayers ( $aryMvpData['mvp_id'] );
					// 結果をキャッシュに入れる
					$this->M_Cache->saveCache ( 'MvpCandidatePlayers_' . $aryMvpData['mvp_id'], $aryMvpCandidatePlayers );
				}
//print nl2br(print_r($aryMvpCandidatePlayers,1));

				$intMvpCandidatePlayerCnt = count ( $aryMvpCandidatePlayers );
				if ( $intMvpCandidatePlayerCnt > 0 ) {
					for ( $i = 0; $i < $intMvpCandidatePlayerCnt; $i++ ) {
						// GameIdなしの場合（個人成績が未登録）
						if ( empty($aryMvpCandidatePlayers[$i]['indi_flg']) == TRUE ) {
							$aryMvpCandidatePlayers[$i]['score'] = NULL;
							$aryMvpCandidatePlayers[$i]['statz'] = NULL;
							continue;
						}
						// 選手：得点
						$intScore3P                                   = (int)$aryMvpCandidatePlayers[$i]['3p_in'] * 3;
						$intScore2P                                   = (int)$aryMvpCandidatePlayers[$i]['2p_in'] * 2;
						$intScoreFT                                   = (int)$aryMvpCandidatePlayers[$i]['ft_in'];
						$aryMvpCandidatePlayers[$i]['score']['TOTAL'] = array (
							'key' => 'PTS',
							'val' => $intScore3P + $intScore2P + $intScoreFT,
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['score']['3PM']   = array (
							'key' => '3PM',
							'val' => $aryMvpCandidatePlayers[$i]['3p_in'],
							'att' => FALSE,
						);
	//					$aryMvpCandidatePlayers[$i]['score']['3Psc']  = array(
	//						'key' => '3Psc',
	//						'val' => $intScore3P,
	//						'att' => FALSE,
	//					);
						$aryMvpCandidatePlayers[$i]['score']['2PM'] = array (
							'key' => '2PM',
							'val' => $aryMvpCandidatePlayers[$i]['2p_in'],
							'att' => FALSE,
						);
	//					$aryMvpCandidatePlayers[$i]['score']['2Psc']  = array(
	//						'key' => '2Psc',
	//						'val' => $intScore2P,
	//						'att' => FALSE,
	//					);
						$aryMvpCandidatePlayers[$i]['score']['FT'] = array (
							'key' => 'FT',
							'val' => $intScoreFT,
							'att' => FALSE,
						);
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && ( $intScore3P + $intScore2P + $intScoreFT ) > 19 ) {
							$aryMvpCandidatePlayers[$i]['score']['TOTAL']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intScore3P > 14 ) {
							$aryMvpCandidatePlayers[$i]['score']['3PM']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intScore2P > 7 ) {
							$aryMvpCandidatePlayers[$i]['score']['2PM']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intScoreFT > 7 ) {
							$aryMvpCandidatePlayers[$i]['score']['FT']['att'] = TRUE;
						}
	//					$aryMvpCandidatePlayers[$i]['score']['TO'] 	= $intScore3P + $intScore2P + $intScoreFT;
						// 選手：スタッツ
						$intStatzOR                                 = (int)$aryMvpCandidatePlayers[$i]['ofr'];
						$intStatzDR                                 = (int)$aryMvpCandidatePlayers[$i]['dfr'];
						$intStatzAS                                 = (int)$aryMvpCandidatePlayers[$i]['assist'];
						$intStatzST                                 = (int)$aryMvpCandidatePlayers[$i]['steal'];
						$intStatzBL                                 = (int)$aryMvpCandidatePlayers[$i]['block'];
						$aryMvpCandidatePlayers[$i]['statz']['OR']  = array (
							'key' => 'OR',
							'val' => $intStatzOR,
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['statz']['DR']  = array (
							'key' => 'DR',
							'val' => $intStatzDR,
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['statz']['TOT'] = array (
							'key' => 'TOT',
							'val' => ( $intStatzOR + $intStatzDR ),
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['statz']['AS']  = array (
							'key' => 'AS',
							'val' => $intStatzAS,
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['statz']['ST']  = array (
							'key' => 'ST',
							'val' => $intStatzST,
							'att' => FALSE,
						);
						$aryMvpCandidatePlayers[$i]['statz']['BL']  = array (
							'key' => 'BS',
							'val' => $intStatzBL,
							'att' => FALSE,
						);
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intStatzOR > 4 ) {
							$aryMvpCandidatePlayers[$i]['statz']['OR']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intStatzDR > 4 ) {
							$aryMvpCandidatePlayers[$i]['statz']['DR']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && ( $intStatzOR + $intStatzDR ) > 5 ) {
							$aryMvpCandidatePlayers[$i]['statz']['TOT']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intStatzAS > 3 ) {
							$aryMvpCandidatePlayers[$i]['statz']['AS']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intStatzST > 3 ) {
							$aryMvpCandidatePlayers[$i]['statz']['ST']['att'] = TRUE;
						}
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' && $intStatzBL > 3 ) {
							$aryMvpCandidatePlayers[$i]['statz']['BS']['att'] = TRUE;
						}
						// MVP選手
						if ( $aryMvpCandidatePlayers[$i]['mvp_flg'] == '1' ) {
							// ゲームID
							$aryMvpPlayerData['game']['game_id'] = $aryMvpCandidatePlayers[$i]['game_id'];
							$intMvpPlayerGameId = $aryMvpCandidatePlayers[$i]['game_id'];
							// プレイヤーID
							$aryMvpPlayerData['player_id'] = $aryMvpCandidatePlayers[$i]['player_id'];
							// プレイヤー名
							$aryMvpPlayerData['player_name'] = $aryMvpCandidatePlayers[$i]['player_name'];
							// プレイヤー名（苗字）
							$aryMvpPlayerData['player_name_first'] = $aryMvpCandidatePlayers[$i]['name_first'];
							// プレイヤー名(カナ)
							$aryMvpPlayerData['player_kana'] = $aryMvpCandidatePlayers[$i]['player_kana'];
							// 所属チームID
							$aryMvpPlayerData['team_id'] = $aryMvpCandidatePlayers[$i]['team_id'];
							// 所属チーム名
							$aryMvpPlayerData['team_name'] = $aryMvpCandidatePlayers[$i]['team_name'];
							// 背番号
							$aryMvpPlayerData['player_no'] = $aryMvpCandidatePlayers[$i]['number'];
							// コメント
							$aryMvpPlayerData['comment'] = nl2br($aryMvpCandidatePlayers[$i]['comment']);
							// 個人得点とスタッツ
							$aryMvpPlayerData['score'] = $aryMvpCandidatePlayers[$i]['score'];
							$aryMvpPlayerData['statz'] = $aryMvpCandidatePlayers[$i]['statz'];
							// 結果から削除
							unset( $aryMvpCandidatePlayers[$i] );
							continue;
						}
					}
				}
			} else {

//				show_error($strErrorMessage, $strStatusCode, $strHeading);
//				exit;

				// 例外処理
				throw new Exception('MVP情報がありません');

			}
//print "<hr>".nl2br(print_r($aryMvpPlayerData,1));
//print nl2br(print_r($aryMvpCandidatePlayers,1));

			// 対戦情報取得
			$arySectionGameData = $this -> M_Cache -> getCache( 'GameData_' . $p_intRarryId . '_' . $p_intClassId . '_' . $p_intSectionNo, CACHE_1S );
			if( $arySectionGameData === FALSE ) {
				$arySectionGameData = $this -> M_GameData -> getSectionGameData( $p_intRarryId, $p_intClassId, $p_intSectionNo );
				// 結果をキャッシュに入れる
				$this -> M_Cache -> saveCache( 'GameData_' . $p_intRarryId . '_' . $p_intClassId . '_' . $p_intSectionNo, $arySectionGameData );
			}
//print nl2br(print_r($arySectionGameData,1));

			// 結果の勝敗設定
			$intSectionGameDataCnt = count($arySectionGameData);
			if ( $intSectionGameDataCnt > 0 ) {
				for ( $i = 0; $i < $intSectionGameDataCnt; $i++ ) {

					// 無効試合は非表示
					if ( $arySectionGameData[$i]['importance'] == '1' ) {
						unset($arySectionGameData[$i]);
						continue;
					}

					// 勝敗
					if ( $arySectionGameData[$i]['score_home'] > $arySectionGameData[$i]['score_away'] ) {
						$arySectionGameData[$i]['resultHome'] = 'win';
						$arySectionGameData[$i]['resultAway'] = 'lose';
					} elseif ( $arySectionGameData[$i]['score_home'] == $arySectionGameData[$i]['score_away'] ) {
						$arySectionGameData[$i]['resultHome'] = 'draw';
						$arySectionGameData[$i]['resultAway'] = 'draw';
					} else {
						$arySectionGameData[$i]['resultHome'] = 'lose';
						$arySectionGameData[$i]['resultAway'] = 'win';
					}

					// MVP選手のゲームは対象外
					if ( $arySectionGameData[$i]['game_id'] == $intMvpPlayerGameId ) {
						$aryMvpPlayerData['game']['result'] = $arySectionGameData[$i];
						unset($arySectionGameData[$i]);
						continue;
					}

					if ( count($aryMvpCandidatePlayers) > 0 ) {
						foreach ( $aryMvpCandidatePlayers as $key => $aryPlayerData ) {
							// ゲームIDが同じMVP候補選手を検出
							if ( $arySectionGameData[$i]['game_id'] == $aryPlayerData['game_id'] ) {

								$arySectionGameData[$i]['mvpCandidatePlayer'] = $aryPlayerData;
								// 選手の写真を検索
								$aryPlayerImageProperties = array(
									'src' => $strPlayerNoImage,
									'alt' => 'MVP候補選手：' . $aryPlayerData['team_name']." #".$aryPlayerData['number']." ".$aryPlayerData['player_name'],
									'width' => '60',
								);
								$strPlayerImageSrc = base_url () . HTTP_DIR_IMAGE . "mvp/" . $p_intRarryId . "/" . $p_intClassId . "/" . $p_intSectionNo . "/" . $aryPlayerData['team_id'] . ".jpg";
								$strPlayerImagThumbSrc = base_url () . HTTP_DIR_IMAGE . "mvp/" . $p_intRarryId . "/" . $p_intClassId . "/" . $p_intSectionNo . "/" . $aryPlayerData['team_id'] . "_f.jpg";
								if ( @file_get_contents ( $strPlayerImagThumbSrc, "r" ) == TRUE ) {
									$aryPlayerImageProperties['src'] = $strPlayerImagThumbSrc;
								}
								$arySectionGameData[$i]['mvpCandidatePlayer']['image'] = $strPlayerImageSrc;
								$arySectionGameData[$i]['mvpCandidatePlayer']['thumb'] = img($aryPlayerImageProperties);
							}
						}
					}

					// 試合日＆試合会場
					if ($strGameDay == '') {
						$strGameDay = $arySectionGameData[$i]['game_day'];
						$strGameHall = $arySectionGameData[$i]['h_name'];
					}
				}
			}

			// 返却データを生成
			$retData['intRarryId']             = $p_intRarryId;
			$retData['aryRarryData']           = $aryRarryData;
			$retData['strGameDay']             = $strGameDay;
			$retData['strGameHall']            = $strGameHall;
			$retData['strSectionNo']           = $p_intSectionNo;
			$retData['arySponsor']             = $arySponsor;
			$retData['aryMvpData']             = $aryMvpData;
			$retData['aryMvpPublicList']       = $aryMvpPublicList;
			$retData['aryMvpPlayerData']       = $aryMvpPlayerData;
			$retData['aryMvpPlayerGameData']   = $aryMvpPlayerGameData;
			$retData['arySectionGameData']     = $arySectionGameData;
			$retData['aryMvpCandidatePlayers'] = $aryMvpCandidatePlayers;

		} catch ( Exception $e ) {
//print nl2br(print_r($e));
//			print $e -> getMessage();
			// データ抹消
			$retData = NULL;

		} finally {

			return $retData;
		}
    }

}