<?php
set_time_limit(0);

require_once 'includes/Base64WithKey.php';
require_once 'phpFastCache/autoload.php';

use phpFastCache\CacheManager;

$l = (isset($_GET['l']) && trim($_GET['l']) !== '') ? trim($_GET['l']) : '';

$data = json_decode(Base64WithKey::decode($l), true);

if (empty($data['link']))
{
    exit;
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/dl.php?l=" . $l;
$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

if ($url == $_SERVER['HTTP_REFERER'])
{
	$config = array(
		'storage' => 'files',
		'path' => __DIR__ . '/cfiles/',
	);
	
	CacheManager::setup($config);

	$cache = CacheManager::get(md5($data['link']));
	
	if (!empty($cache))
	{
		exit($cache);
	}
}