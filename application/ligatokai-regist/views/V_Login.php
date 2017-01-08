	<header>
		<h1><?= SITE_TITLE . SYSTEM_TITLE; ?></h1>
		<h2>ログイン画面</h2>
	</header>

	<main>
		<div id="inputArea">
			<h3>ログインIDとパスワードを入力して、対象大会を選択してください。</h3>
			<table>
				<tbody>
				<tr>
					<th>ログインID</th>
					<td>
						<input type="text" size="30" id="loginId" name="loginId" value="<?= $loginId; ?>"><?= form_error('loginId'); ?>
					</td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td>
						<input type="password" size="30" id="passwd" name="passwd">
					</td>
				</tr>
				<tr>
					<th>対象大会</th>
					<td id="rarrySelect"></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="2">
						<button id="submit">ログイン</button>
					</td>
				</tr>
				</tfoot>
			</table>
			<div id="reissue"><a href="#modal" id="reissueWindow">ログインID・パスワードの確認はこちら</a></div>
		</div>
		<div id="subArea">
			<section>
				<h3>マニュアル&nbsp;Download</h3>
				<ul id="manual">
					<li>
						<?= img("common/image/pdf_16.png"); ?><a href="./manual/member_regist.pdf" target="_blank">操作マニュアル</a>&nbsp<span class="extention">(PDFファイル)</span>
					</li>
				</ul>
			</section>
		</div>
	</main>
	<div class="remodal" data-remodal-id="modal">
		<button data-remodal-action="close" class="remodal-close"></button>
		<section id="reissueView">
			<h1><?= SITE_TITLE . SYSTEM_TITLE; ?></h1>
			<h2>ログインID・パスワード再発行</h2>
			<p>
				チーム【&nbsp;<span>代表者もしくは副代表者</span>&nbsp;】のメールアドレスを入力してください。<br>
				照合されたチーム情報のID・パスワードをメールでお送りします。
			</p>
			<table>
				<tr>
					<th>所属チーム</th>
					<td>
						<select id="reissueTeamId" name="tid">
							<option value="247">TEST</option>
							<optgroup label="1部">
								<option value="24">ARMADA</option>
								<option value="114">CHARA-S</option>
								<option value="128">CHERRY</option>
								<option value="136">INFRONT RECORD</option>
								<option value="16">JAM</option>
								<option value="14">LINKS</option>
								<option value="129">OTL</option>
								<option value="41">Peace Porter</option>
								<option value="62">Ｓ</option>
								<option value="148">SNAKERS</option>
								<option value="30">TEN FEET</option>
								<option value="2">晴天也</option>
							</optgroup>
							<optgroup label="下部A">
								<option value="78">atehaca</option>
								<option value="112">ATRACADOR</option>
								<option value="147">Bashiko</option>
								<option value="155">Chrome</option>
								<option value="120">CLUTCH</option>
								<option value="180">four-twenty</option>
								<option value="110">G</option>
								<option value="177">Marshal</option>
								<option value="162">SHM</option>
								<option value="28">Union</option>
							</optgroup>
							<optgroup label="下部B">
								<option value="27">AndrewWalkers</option>
								<option value="171">Camel</option>
								<option value="176">compagno</option>
								<option value="169">cryshens</option>
								<option value="156">GAIA</option>
								<option value="181">gidai club</option>
								<option value="87">JUSTICE</option>
								<option value="33">KIWIS</option>
								<option value="56">NBNL</option>
								<option value="138">いろはす</option>
							</optgroup>
							<optgroup label="下部C">
								<option value="182">albatross</option>
								<option value="158">APM</option>
								<option value="172">boost</option>
								<option value="184">Elephants</option>
								<option value="178">ixi</option>
								<option value="170">Jokers</option>
								<option value="68">mantis</option>
								<option value="164">QUARTZ</option>
								<option value="133">REDBULLS</option>
								<option value="63">SERIOLA</option>
							</optgroup>
							<optgroup label="下部D">
								<option value="167">BABEL</option>
								<option value="183">Black Out</option>
								<option value="179">CHEZ</option>
								<option value="174">grass hopper</option>
								<option value="46">HOPE</option>
								<option value="29">KOBS</option>
								<option value="157">MEDLEY</option>
								<option value="163">Scor-Pions</option>
								<option value="37">STANCE</option>
								<option value="65">ルーテック・サクライ</option>
							</optgroup>
							<optgroup label="2部A">
								<option value="106">Accent</option>
								<option value="4">CrazyTroops</option>
								<option value="132">fabulous</option>
								<option value="168">G.A. Möbius hoop</option>
								<option value="8">GRAY-HOUNDS</option>
								<option value="39">K-germs</option>
								<option value="38">old mountains</option>
								<option value="53">Rock in</option>
								<option value="11">SDB</option>
								<option value="143">TENHO</option>
								<option value="160">ZEST</option>
								<option value="166">はまSUNS</option>
							</optgroup>
							<optgroup label="2部B">
								<option value="153">abnormal</option>
								<option value="23">BLAST</option>
								<option value="149">GERM</option>
								<option value="59">GERMAN</option>
								<option value="89">ILC</option>
								<option value="90">LEGARIS</option>
								<option value="141">PHUNK</option>
								<option value="142">RACCOON  DOG</option>
								<option value="165">RISE</option>
								<option value="67">Shining Sun</option>
								<option value="13">倭寇</option>
								<option value="52">残波</option>
							</optgroup>
						</select>
					</td>
				</tr>
				<tr>
					<th>メールアドレス</th>
					<td>
						<input type="text" size="80" id="reissueEmail" name="email">
					</td>
				</tr>
				<tfoot>
					<tr>
						<td colspan="2">
							<button data-remodal-action="confirm" id="reissueMail" class="remodal-confirm">送信</button>
							<button data-remodal-action="cancel" class="remodal-cancel">Close</button>
						</td>
					</tr>
				</tfoot>
			</table>
		</section>
	</div>