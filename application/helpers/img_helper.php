<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function thumb_path($uri = '')
{
	$CI =& get_instance();
	return $CI->config->site_url($uri);
}

function big_path()
{

}


