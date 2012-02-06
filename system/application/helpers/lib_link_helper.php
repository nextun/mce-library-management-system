<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function base_app_url()
{
	$CI = & get_instance();
	return $CI->config->item('base_url');
	//return 'http://localhost/library/';
}

// For forgot passowrd URL
function forgot_password_url()
{
	$CI = & get_instance();
    $config = $CI->config->load('library/config');

	$base_forgot_pass_url = $CI->config->item('forgor_password_link');
    $encode_base_url = urlencode(base_app_url());
    $final_forgot_pass_url = str_replace('{success_url}', $encode_base_url , $base_forgot_pass_url );

    return $final_forgot_pass_url;

}

function login_url()
{
	$CI = & get_instance();
    $config = $CI->config->load('library/config');
	$login_url = $CI->config->item('login_url');
    $encode_base_url = urlencode(base_app_url());
    $final_login_url = str_replace('{success_url}', $encode_base_url , $login_url );
    return $final_login_url;
}



function url_link($url  = '')
{
	return base_app_url().$url;
}

function asset_link($filename, $add_version = true)
{
	$CI = & get_instance();
    $config = $CI->config->load('config');
	$static_content_version = $CI->config->item('static_version');
	
	$CI =& get_instance();
	$file = APPPATH . 'assets/' . $filename;
	
	$url = $CI->config->item('base_url') . ADD . basename(APPPATH) .'/assets/' . $filename;
	if($add_version)
		$url .= "?v=" . $static_content_version;
	return $url;
}

function image_link($image_filename)
{
	return asset_link('images/' . $image_filename);
}

function js_link($js_filename, $return = false)
{
	if(!$return)
	{
		$link = asset_link('js/' . $js_filename);
		return "<script language='javascript' type='text/javascript' src='$link' ></script>";
	}
	else
	{
		$js_dir = APPPATH . 'assets/js/';
		$file = $js_dir . $js_filename;
		if(file_exists($file))
		{
			$js = htmlentities(file_get_contents($file));
			$js = "<script>" . $js . "</script>";
			return $js;
		}
	}
}

function css_link($css_filename, $return = false)
{
	$CI = & get_instance();
	$config = $CI->config->load('config');
	$static_content_version = $CI->config->item('static_version');		
	$cached_filename = "v" . $static_content_version . "_" . $css_filename;
	
	if(!$return) {
		//$link = asset_link('css/cache/' . $cached_filename);
		$link = asset_link('css/' . $css_filename);
		return "<link rel='stylesheet' type='text/css' href='" . $link . "' />";
	} else {
		$file = APPPATH . 'assets/css/cache/' . $cached_filename;
		$css = htmlentities(file_get_contents($file));
		$css = "<style>" . $css . "</style>";
		return $css;
	}
}

function set_language($lang)
	{
        $CI =& get_instance();
		$item = $CI->config->item('languages');
	}

?>