<?php
/**
 * HTMLフッター用のヘルパー
 *
 * HTMLフッターを作成して返却
 *
 * @author	imai
 * @since	20160116 新規作成
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getHtmlFooter'))
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
	function getHtmlFooter ( $p_aryLoadJs ) {

		$strHtmlFooter = '';
		$strJsStyle = '';

		if ( USE_HTML5 === FALSE ) {
			$strJsStyle = ' type="text/javascript"';
		}
		// Jvascript設定
		if ( count($p_aryLoadJs) > 0 ) {
			foreach ($p_aryLoadJs as $type => $files) {
				if ( $type === "inline" ) {
					$strHtmlFooter .= '	<script' . $strJsStyle . '>' . LF;
					$strHtmlFooter .= $type['inline'] . LF;
					$strHtmlFooter .= '	</script>' . LF;
				} else {
					$strHtmlFooter .= '	<script' . $strJsStyle . ' src="' . COMMON_DIR . '/js/' . $files . '"></script>' . LF;
				}
			}
		}
		$strHtmlFooter .= '	</body>' . LF;
		$strHtmlFooter .= '</html>';

		return $strHtmlFooter;
	}
}

?>