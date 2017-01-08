<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends MY_Model {

    function __construct () {
        // Model クラスのコンストラクタを呼び出す
        parent::__construct();

        // ヘルパー設定
        $this->load->helper(
            array('form')
        );
        // CSS・Javascript設定
		$this -> _aryLoadCss = array('login');
		$this -> _aryLoadJs = array('login');
    }

	/**
	 * モデル
	 *
	 * @return array
	 */
    function main() {

        $aryData = array();
		$p_strLoginId = '';
        $aryRarryData = array();

		$p_strLoginId 	= $this -> input -> post('loginId');

        // データをビューに渡す
		$aryData['aryRarryData'] 		= $aryRarryData;
		$aryData['loginId'] 			= $p_strLoginId;

        return $aryData;
    }

	/**
	 * チームの大会登録情報を取得
	 *
	 * @return array
	 */
	function getTeamRarryData() {

		$aryData = array();
		$aryTeamData = NULL;
		$aryTeamRegistRarryData = NULL;
		$p_strLoginId = '';
		$p_strPasswd = '';
		$strErrorMessage = '';

		// ライブラリ
		$this -> load -> library('form_validation');

		try {

			// POSTデータ取得
			$p_strLoginId 	= $this -> input -> post('loginId');
			$p_strPasswd 	= $this -> input -> post('passwd');

			// パスワードをハッシュ化
			$strPassword = hash('ripemd160', $p_strPasswd);

			$aryValidationConfig = array(
				array(
					'field' => 'loginId',
					'label' => 'ログインID',
					'rules' => 'required|alpha_numeric|min_length[5]',
					'errors' => array(
						'required' => '%s は必須です。',
						'alpha_numeric' => '%s は英数字のみです。',
					),
				),
				array(
					'field' => 'passwd',
					'label' => 'パスワード',
					'rules' => 'required|alpha_numeric|exact_length[6]',
					'errors' => array(
						'required' => '%s は必須です。',
						'alpha_numeric' => '%s は英数字のみです。',
					),
				),
			);

			// バリデーション
			$this -> form_validation -> set_rules($aryValidationConfig);
			if ( $this->form_validation->run() == FALSE ) {
				$aryData['loginId'] 			= NULL;
				$aryData['passwd'] 				= NULL;
				throw new Exception();
			}

			// チーム登録情報取得
			$aryTeamData = $this -> M_TeamData -> chechTeamInfoData( $p_strLoginId, $strPassword );
			if ( empty($aryTeamData) == TRUE ) {
				$aryData['errorMessage'] = 'チーム情報なし';
				throw new Exception();
			}

			$intTeamId = $aryTeamData['team_id'];

			// 登録可能な大会情報取得
			$aryTeamRegistRarryData = $this -> M_TeamData -> getTeamRegistRarryData( $intTeamId );
			if ( empty($aryTeamRegistRarryData) == TRUE ) {
				$aryData['errorMessage'] = '登録可能な大会情報なし';
				throw new Exception();
			}

			// データをビューに渡す
			$aryData['teamId'] 			= $intTeamId;
			$aryData['teamRegistData'] 	= $aryTeamRegistRarryData;
			$aryData['loginId'] 		= $p_strLoginId;
			$aryData['passwd'] 			= $p_strPasswd;

			return $aryData;

		} catch ( Exception $e ) {

			$aryData['passwd'] 				= NULL;

			// エラー処理
			return FALSE;
		}

	}

	/**
	 * チームの大会登録情報を取得
	 *
	 * @return array
	 */
	function checkRepresentEmail() {

		$aryData = array();
		$aryTeamRepresentData = NULL;

		// ライブラリ
		$this -> load -> library('form_validation');
		$this -> load -> library('email');

		try {

			// POSTデータ取得
			$p_strTeamId 	= $this -> input -> post('teamId');
			$p_strEmail 	= $this -> input -> post('email');

			$aryValidationConfig = array(
				array(
					'field' => 'teamId',
					'label' => 'チームID',
					'rules' => 'required|numeric|min_length[1]',
					'errors' => array(
						'required' => '%s は必須です。',
						'alpha_numeric' => '%s は数字のみです。',
					),
				),
				array(
					'field' => 'email',
					'label' => 'メールアドレス',
					'rules' => 'required|valid_email',
					'errors' => array(
						'required' => '%s は必須です。',
						'alpha_numeric' => '%s はメール形式ではありません。',
					),
				),
			);

			// バリデーション
			$this -> form_validation -> set_rules($aryValidationConfig);
			if ( $this->form_validation->run() == FALSE ) {
				throw new Exception();
			}

			// チーム情報に代表・副代表の情報を取得する。
			$aryTeamRepresentData = $this -> M_TeamData -> getTeamRepresentData( $p_strTeamId );
			if ( empty($aryTeamRepresentData) == TRUE ) {
				$aryData['errorMessage'] = '代表・副代表の情報なし';
				throw new Exception();
			}

			// メールアドレスの整合性をチェックする。
			if ( array_search( $p_strEmail, $aryTeamRepresentData ) == TRUE ) {
				// メールアドレスが一致した場合は正常として、メール送信処理
				$this->email->from(LEAGUE_EMAIL, SITE_TITLE . '事務局');
				$this->email->to('imai.0221@gmail.com');

				$this->email->subject('Email Test');
				$this->email->message('Testing the email class.');

				$this->email->send();
print "Email";

				return TRUE;
			}

			return FALSE;

		} catch ( Exception $e ) {

			// エラー処理
			return FALSE;
		}

	}

}