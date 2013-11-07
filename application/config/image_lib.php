<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['image_library'] = 'gd2'; // выбираем библиотеку
$config['maintain_ratio'] = true;
$config['quality'] = 100;
$config['root_dir'] = $_SERVER['DOCUMENT_ROOT'] . '/karin/public/assets/img/';
$config['projects_root_dir'] = $config['root_dir'] . 'projects/%d/';
$config['thumb_dir'] = 'thumb/';
$config['big_dir'] = 'big/';
$config['sizes'] = [
	$config['thumb_dir'] => ['width' => 300, 'height' => 400],
	$config['big_dir'] => ['width' => 600, 'height' => 800]
];
$config['valid_types'] = ['jpg', 'jpeg', 'gif', 'png'];
