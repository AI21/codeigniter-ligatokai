<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        // 開発環境のみ：エラー表示
        if ( ENVIRONMENT === 'production' ) {
            $this->output->enable_profiler(TRUE);
        }

    }

	/**
	 * テーマ切り替え用関数
	 *
	 * @param string サブフォルダ/ビューファイル名
	 * @return string テーマディレクトリ
	 */
	public function get_theme($view) {

//	    $this -> load -> library('user_agent');
//
//		// iPad判定
//		if(strpos($this->agent->agent_string(),'iPad') == TRUE) {
//			return $view;
//		}
//
//		// スマホ判定
//	    if ( $this -> agent -> is_mobile() ) {
//	        return '_smartphone/' . $view . '_sp';
//	    }
	    return $view;
	}

}

?>