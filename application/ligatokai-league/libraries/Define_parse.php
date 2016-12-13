<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Define_parse {

	/*
	 * 定数の中身を取得
	 *
	 * ヒアドキュメント内で定数を使用する場合
	 *
	 * param $strDefineKey	: 定数名
	 * return 定数の値
	 *
	 * since 20160801 imai 新規作成
	 */
	public function getDef($strDefineKey){
		return constant($strDefineKey);
	}
}
?>