<?php $strBreakName = ''; ?>
		<header>
			<h1>リーガ東海 1部 第<?= $strSectionNo; ?>節</h1>
			<h2><?= $arySponsor['sponsor_view']; ?> プレゼンツ</h2>
			<p>
				<?= $strGameDay; ?> <?= $strGameHall; ?>
			</p></p>
<?php if ( count($aryMvpPublicList) > 0 ) : ?>
				<div id="navArea">
					<nav>
						<ol>
<?php foreach ($aryMvpPublicList as $strPublicList): // MVPリスト ?>
<?php if ( $strPublicList['rarry_sub_name'] != $strBreakName ) : ?>
									<li class="season"><?= $strPublicList['rarry_sub_name']; ?></li>
<?php
	$strBreakName = $strPublicList['rarry_sub_name'];
	endif;
?>
								<li><a href="<?= LEAGUE_DIR_MVP ?>/<?= $strPublicList['r_id']; ?>/1/<?= $strPublicList['section_no']; ?>/"><?= $strPublicList['section_no']; ?>節</a></li>
<?php endforeach;?>
						</ol>
					</nav>
				</div>
<?php endif;?>
		</header>
		<main>
			<div id="gameSection" class="popup">
				<div id="mvpGame">
					<div id="mvpPlayer">
						<section id="playerDetail">
							<h1>MVP PLAYER</h1>
							<a href="<?= LEAGUE_DIR_IMAGE ?>mvp/<?= $intRarryId; ?>/<?= $aryRarryData['progress']; ?>/<?= $strSectionNo; ?>/mvp_player.jpg">
								<img src="<?= LEAGUE_DIR_IMAGE ?>mvp/<?= $intRarryId; ?>/<?= $aryRarryData['progress']; ?>/<?= $strSectionNo; ?>/mvp_player_sp.jpg"
									 alt="リーガ東海 1部 第<?= $strSectionNo; ?>節 MVP [ <?= $aryMvpPlayerData['player_name']; ?> : <?= $aryMvpPlayerData['team_name']; ?> No.<?= $aryMvpPlayerData['player_no']; ?> ]">
							</a>
							<div class="playerDtl">
								<dl>
									<dt>チーム</dt><dd><?= $aryMvpPlayerData['team_name']; ?></dd>
									<dt>プレイヤー</dt><dd>No.<?= $aryMvpPlayerData['player_no']; ?>　<?= $aryMvpPlayerData['player_name']; ?></dd>
								</dl>
								<p><?= $aryMvpPlayerData['comment']; ?></p>
							</div>
						</section>
						<div id="scoreStatz">
							<div id="boxScore">
								<section>
									<h2>Box Score</h2>
									<table>
										<tbody>
										<tr>
											<th><?= $aryMvpPlayerData['game']['result']['home_team_name']; ?></th>
											<td class="<?= $aryMvpPlayerData['game']['result']['resultHome']; ?>"><?= $aryMvpPlayerData['game']['result']['score_home']; ?></span></td>
											<td rowspan="2"><button onclick="javascript:openWindow(<?= $aryMvpPlayerData['game']['game_id']; ?>);">ゲーム詳細</button></td>
										</tr>
										<tr>
											<th><?= $aryMvpPlayerData['game']['result']['away_team_name']; ?></th>
											<td class="<?= $aryMvpPlayerData['game']['result']['resultAway']; ?>"><?= $aryMvpPlayerData['game']['result']['score_away']; ?></span></td>
										</tr>
										</tbody>
									</table>
								</section>
							</div>
							<div id="playerStatz">
								<section>
									<h2>Player Statz</h2>
									<table>
										<thead>
										<tr>
											<th colspan="4" class="mvpStatz">Point</th>
											<th colspan="3" class="mvpStatz">Rebound</th>
											<th rowspan="2" class="mvpStatz">AS</th>
											<th rowspan="2" class="mvpStatz">ST</th>
											<th rowspan="2" class="mvpStatz">BL</th>
										</tr>
										<tr>
											<th class="mvpStatz">PTS</th>
											<th class="mvpStatz">3PM</th>
											<th class="mvpStatz">2PM</th>
											<th class="mvpStatz">FT</th>
											<th class="mvpStatz">OR</th>
											<th class="mvpStatz">DR</th>
											<th class="mvpStatz">TO</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td class="mvpStatz score"><span<?= ($aryMvpPlayerData['score']['TOTAL']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['score']['TOTAL']['val']; ?></span></td>
											<td class="mvpStatz score"><span<?= ($aryMvpPlayerData['score']['3PM']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['score']['3PM']['val']; ?></span></td>
											<td class="mvpStatz score"><span<?= ($aryMvpPlayerData['score']['2PM']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['score']['2PM']['val']; ?></span></td>
											<td class="mvpStatz score"><span<?= ($aryMvpPlayerData['score']['FT']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['score']['FT']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['OR']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['OR']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['DR']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['DR']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['TOT']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['TOT']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['AS']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['AS']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['ST']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['ST']['val']; ?></span></td>
											<td class="mvpStatz statz"><span<?= ($aryMvpPlayerData['statz']['BL']['att'] == TRUE) ? ' class="att"': ''; ?>><?= $aryMvpPlayerData['statz']['BL']['val']; ?></span></td>
										</tr>
										</tbody>
									</table>
								</section>
							</div>
						</div>
					</div>
				</div>
				<div id="resultArea">
					<section id="sectionGame">
						<h2>MUTCH DAY MVP</h2>
						<ol>
<?php foreach ($arySectionGameData as $resultGame): // 対戦結果 ?>
							<li>
								<a href="<?= $resultGame['mvpCandidatePlayer']['image']; ?>">
									<?= $resultGame['mvpCandidatePlayer']['thumb']; ?>
								</a>
								<div class="resultGameArea">
									<div class="resultGame">
										<table>
											<tr class="home">
												<th class="team"><?= $resultGame['home_team_name']; ?></th>
												<td class="score <?= $resultGame['resultHome']; ?>"><?= $resultGame['score_home']; ?></td>
												<td class="detail" rowspan="2"><button onclick="javascript:openWindow(<?= $resultGame['game_id']; ?>);">ゲーム<br>詳細</button></td>
											</tr>
											<tr class="away">
												<th class="team"><?= $resultGame['away_team_name']; ?></th>
												<td class="score <?= $resultGame['resultAway']; ?>"><?= $resultGame['score_away']; ?></td>
											</tr>
										</table>
									</div>
									<div class="mvpCandicate">
										<div class="player">
											<h3>MVP候補選手</h3>
											<p>
												<?= $resultGame['mvpCandidatePlayer']['team_name']; ?><br>
												No.<?= $resultGame['mvpCandidatePlayer']['number']; ?> <?= $resultGame['mvpCandidatePlayer']['player_name']; ?>
											</p>
										</div>
									</div>
								</div>
							</li>
<?php endforeach;?>
							<li class="sponsorGoods">
<?php if ( isset($arySponsor['goods_image']) == TRUE) : // 提供商品 ?>
								<img src="<?= $arySponsor['goods_image']; ?>" alt="<?= $arySponsor['sponsor_view']; ?>様提供「<?= $arySponsor['goods_name']; ?>」" width="100">
<?php endif;?>
								<p>
									<?= $aryMvpPlayerData['player_name']; ?>選手には、冠協賛の<?= $arySponsor['sponsor_view']; ?>様より「<?= $arySponsor['goods_name']; ?>」が進呈されます！
								</p>
							</li>
						</ol>
					</section>
<?php /*
					<section id="candidate">
						<h2>【MVP候補選手】</h2>
<?php foreach ($aryMvpCandidatePlayers as $players): // 対戦結果 ?>
							<div class="candidate">
								<img src="" alt="<?= $players['player_name']; ?>">
								<p>
									<dl>
										<dt><?= $players['team_name']; ?></dt>
										<dd>No.<?= $players['number']; ?> <?= $players['player_name']; ?><?= $players['player_id']; ?></dd>
									</dl>
								</p>
							</div>
<?php endforeach;?>
						</table>
					</section>
*/ ?>
				</div>
			</div>
			<div id="sponsorArea">
				<section>
					<h3><?= $arySponsor['shop_name']; ?></h3>
					<div id="shopImg" class="popup">
<?php foreach ($arySponsor['shop_img'] as $shopImage ): // ショップデータ ?>
						<a href="<?= $shopImage['src']; ?>">
							<?= $shopImage['img']; ?>
						</a>
<?php endforeach;?>
					</div>
					<div id="shopData">
						<div id="dataArea">
							<dl>
<?php foreach ($arySponsor['shop_data'] as $shopData ): // ショップデータ ?>
<?php if ($shopData['key'] == 'TEL') : ?>
								<dt><?= $shopData['key']; ?></dt><dd><a href="tel:<?= $shopData['val']; ?>"><?= $shopData['val']; ?></a></dd>
<?php else: ?>
								<dt><?= $shopData['key']; ?></dt><dd><?= $shopData['val']; ?></dd>
<?php endif;?>
<?php endforeach;?>
							</dl>
						</div>
<?php if ( isset($arySponsor['shop_sns']) == TRUE) : // ショップデータ ?>
						<div id="snsArea">
							<ol>
<?php foreach ($arySponsor['shop_sns'] as $shopSns ): // ショップデータ ?>
								<li class="<?= $shopSns['key']; ?>">
									<a href="<?= $shopSns['link']; ?>" target="_blank">
										<img src="<?= COMMON_DIR_IMAGE; ?>/sns/<?=($shopSns['key']); ?>.svg" width="60" height="60" alt="<?= $arySponsor['sponsor_view']; ?> <?= $shopSns['val']; ?>">
										<?= $shopSns['val']; ?>
									</a>
								</li>
<?php endforeach;?>
							</ol>
						</div>
<?php endif;?>
					</div>
				</section>
			</div>
		</main>
