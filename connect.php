<?php

date_default_timezone_set('Asia/Jakarta');

$db = [
	'host' => 'localhost',
	'user' => 'root',
	'pass' => '',
	'name' => 'shortlink_db'
];

$conn = mysqli_connect($db['host'],$db['user'],$db['pass'],$db['name']);

if(!$conn) {
	die(mysqli_connect_error());
}

$date = date('Y-m-d');
$time = date('H:i:s');

$site = [
	'root'  => 'http://localhost/short/',
	'judul' => 'ShortLink Free For Blogger',
	'desc'	=> 'Pemendek url gratis 100% aman'
];