<?php
function cURL($url, $referer = false, $data = false, $header = false)
{
	$ch = curl_init();

	$ck = __DIR__ . '/ckx.txt';
	
	$opts = array(
		CURLOPT_URL => $url,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
		CURLOPT_FOLLOWLOCATION => TRUE,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_TIMEOUT => 10,
		CURLOPT_COOKIEJAR => $ck,
		CURLOPT_COOKIEFILE => $ck,
		CURLOPT_ENCODING => 'gzip, deflate',
		CURLOPT_USERAGENT => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
		);

	if ($data)
	{
		$opts[CURLOPT_POST] = true;
		$opts[CURLOPT_POSTFIELDS] = $data;
	}

	if ($referer)
	{
		$opts[CURLOPT_REFERER] = $referer;
	}

	if ($header)
	{ 
		$opts[CURLOPT_HTTPHEADER] = $header;
	}

	curl_setopt_array($ch, $opts);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function getRedirectURL($url)
{
	$ch = curl_init();

	$ck = __DIR__ . '/ckx.txt';
	
	$opts = array(
		CURLOPT_URL => $url,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_SSL_VERIFYHOST => FALSE,
		CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
		CURLOPT_FOLLOWLOCATION => TRUE,
		CURLOPT_NOBODY => TRUE,
		CURLOPT_CUSTOMREQUEST => 'HEAD',
		CURLOPT_TIMEOUT => 10,
		CURLOPT_COOKIEJAR => $ck,
		CURLOPT_COOKIEFILE => $ck,
		CURLOPT_ENCODING => 'gzip, deflate',
		CURLOPT_USERAGENT => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
		);
		

	curl_setopt_array($ch, $opts);
	curl_exec($ch);
	
	$result = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
	
	curl_close($ch);
	return $result;
}

function getClientIP()
{
	if (getenv('HTTP_CLIENT_IP'))
		$ip = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ip = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ip = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ip = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ip = getenv('REMOTE_ADDR');
	else
		$ip = '0.0.0.0';

	return $ip;
}