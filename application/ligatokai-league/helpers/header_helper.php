<?php
/**
 * HTMLヘッダー用のヘルパー
 *
 * HTMLヘッダーを作成して返却
 *
 * @author	imai
 * @since	20160116 新規作成
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getHtmlHeader'))
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
	function getHtmlHeader ( $p_aryDataHeader, $p_aryLoadCss = '', $p_aryLoadJs = '', $p_doctypes = 'xhtml1-strict' ) {

		$strHtmlHeader = '';

		$CI =& get_instance();

		$strPageTitle = '';
		$strMetaKeywords = implode( ',', $CI -> config -> item('SITE_KEYWORDS') );
		$strMetaDescription = '';

		// テキスト設定
		$strPageTitle = ( isset( $p_aryDataHeader['title'] ) && $p_aryDataHeader['title'] !== '' ? $p_aryDataHeader['title'] : $CI -> config -> item('SITE_TITLE') );
		if ( isset( $p_aryDataHeader['keywords'] ) && $p_aryDataHeader['keywords'] !== '' ) {
			$strMetaKeywords .= explode(',', $p_aryDataHeader['keywords']) . ',';
		}
		if ( isset( $p_aryDataHeader['description'] ) && $p_aryDataHeader['description'] !== '' ) {
			$strMetaDescription .= explode(',', $p_aryDataHeader['description']) . '｜';
		}
		$strMetaDescription .= $CI->config->item('SITE_DESCRIPTION');

		if ( USE_HTML5 === TRUE ) {
			$strHtmlHeader .= doctype() . LF;
			// $strHtmlHeader .= '<html>' . LF;
			$strHtmlHeader .= '<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->' . LF;
			$strHtmlHeader .= '<!--[if gt IE 8]><!--> <html lang="' . $CI -> config -> item('htmlLang') . '"> <!--<![endif]-->' . LF;
			$strHtmlHeader .= '<head>' . LF;
			$strHtmlHeader .= '	<meta charset="' . $CI -> config -> item('charset') . '">' . LF;
			$strHtmlHeader .= '	<meta name="viewport" content="width=device-width,initial-scale=1.0">' . LF;
			$strHtmlHeader .= '	<meta http-equiv="X-UA-Compatible" content="IE=edge">' . LF;
			$strHtmlHeader .= '	<title>' . $strPageTitle . '</title>' . LF;
			$strHtmlHeader .= '	<meta name="keywords" content="' . $strMetaKeywords . '">' . LF;
			$strHtmlHeader .= '	<meta name="description" content="' . $strMetaDescription . '">' . LF;

			// $strHtmlHeader .= '	<meta property="og:site_name" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:type" content="website">' . LF;
			// $strHtmlHeader .= '	<meta property="og:url" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:title" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:description" content="">' . LF;
			// $strHtmlHeader .= '	<meta name="format-detection" content="telephone=no">' . LF;

			// CSS設定
			if ( count($p_aryLoadCss) > 0 && $p_aryLoadCss !== '') {
				foreach ($p_aryLoadCss as $files) {
					$strHtmlHeader .= '	<link rel="stylesheet" href="' . $CI->config->item('COMMON_DIR') . $files . '.css">' . LF;
				}
			}
			// モバイル対応
			if ( $CI -> agent -> is_mobile() ) {
				$strHtmlHeader .= '	<link rel="stylesheet" href="' . $CI->config->item('COMMON_DIR') . 'filtersp.css">' . LF;
			}
			$strHtmlHeader .= '	' . link_tag('aaaa');

			// Jvascript設定
			if ( count($p_aryLoadJs) > 0 && $p_aryLoadJs !== '' ) {
				foreach ($p_aryLoadJs as $type => $files) {
					if ( $type === "inline" ) {
						$strHtmlHeader .= '	<script>' . LF;
						$strHtmlHeader .= $type['inline'] . LF;
						$strHtmlHeader .= '	</script>' . LF;
					} else {
						$strHtmlHeader .= '	<script src="' . $CI->config->item('COMMON_DIR') . '/js/' . $files . '"></script>' . LF;
					}
				}
			}

			$strHtmlHeader .= '	<!--[if lt IE 9]>' . LF;
			$strHtmlHeader .= '	<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>' . LF;
			$strHtmlHeader .= '	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>' . LF;
			$strHtmlHeader .= '	<![endif]-->' . LF;
			$strHtmlHeader .= '</head>' . LF;
		// HTML5以外のヘッダー
		} else {
			$strHtmlHeader .= doctype($p_doctypes) . LF;
			$strHtmlHeader .= '<html xmlns="http://www.w3.org/1999/xhtml" lang="' . $CI -> config -> item('htmlLang') . '" xml:lang="' . $CI -> config -> item('htmlLang') . '" dir="ltr">' . LF;
			$strHtmlHeader .= '<head>' . LF;
			$strHtmlHeader .= '	<meta http-equiv="Content-Type" content="text/html; charset=' . $CI -> config -> item('charset') . '" />' . LF;
			$strHtmlHeader .= '	<title>' . $strPageTitle . '</title>' . LF;
			$strHtmlHeader .= '	<meta name="keywords" content="' . $strMetaKeywords  . '" />' . LF;
			$strHtmlHeader .= '	<meta name="description" content="' . $strMetaDescription . '" />' . LF;
			$strHtmlHeader .= '	<meta http-equiv="Content-Script-type" content="text/javascript" />' . LF;
			$strHtmlHeader .= '	<meta http-equiv="Content-Style-type" content="text/css" />' . LF;
			$strHtmlHeader .= '	<link rel="stylesheet" href="' . $CI->config->item('COMMON_DIR') . '/css/fillter.css" />' . LF;
			// CSS設定
			if ( count($p_aryLoadCss) > 0 ) {
				foreach ($p_aryLoadCss as $files) {
					$strHtmlHeader .= '	<link rel="stylesheet" href="' . $CI->config->item('COMMON_DIR') . $files . '.css">' . LF;
				}
			}
			// $strHtmlHeader .= '	<meta property="og:site_name" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:type" content="website">' . LF;
			// $strHtmlHeader .= '	<meta property="og:url" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:title" content="">' . LF;
			// $strHtmlHeader .= '	<meta property="og:description" content="">' . LF;
			// $strHtmlHeader .= '	<meta name="format-detection" content="telephone=no">' . LF;

			// Jvascript設定
			if ( count($p_aryLoadJs) > 0 ) {
				foreach ($p_aryLoadJs as $type => $files) {
					if ( $type === "inline" ) {
						$strHtmlHeader .= '	<script type="text/javascript">' . LF;
						$strHtmlHeader .= $type['inline'] . LF;
						$strHtmlHeader .= '	</script>' . LF;
					} else {
						$strHtmlHeader .= '	<script src="' . $CI->config->item('COMMON_DIR') . '/js/' . $files . '"></script>' . LF;
					}
				}
			}
			$strHtmlHeader .= '</head>' . LF;
		}

		return $strHtmlHeader;
		//'<h'.$h._stringify_attributes($attributes).'>'.$data.'</h'.$h.'>';
	}
}

?>