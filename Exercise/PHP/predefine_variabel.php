<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan Predifine Variabel</title>
</head>

<body>
<?php
	$GLOBALS['a']='A';
	echo '$GLOBALS[\'a\'] = '.$GLOBALS['a'].'<br />';
	
	echo '$_SERVER[\'PHP_SELF\'] = '.$_SERVER['PHP_SELF'].'<br />';
	echo '$_SERVER[\'argc\'] = '.$_SERVER['argc'].'<br />';
	echo '$_SERVER[\'argv\'] = '.$_SERVER['argv'].'<br />';
	echo '$_SERVER[\'GATEWAY_INTERFACE\'] = '.$_SERVER['GATEWAY_INTERFACE'].'<br />';
	echo '$_SERVER[\'SERVER_ADDR\'] = '.$_SERVER['SERVER_ADDR'].'<br />';
	echo '$_SERVER[\'SERVER_NAME\'] = '.$_SERVER['SERVER_NAME'].'<br />';
	echo '$_SERVER[\'SERVER_SOFTWARE\'] = '.$_SERVER['SERVER_SOFTWARE'].'<br />';
	echo '$_SERVER[\'SERVER_PROTOCOL\'] = '.$_SERVER['SERVER_PROTOCOL'].'<br />';
	echo '$_SERVER[\'REQUEST_METHOD\'] = '.$_SERVER['REQUEST_METHOD'].'<br />';
	echo '$_SERVER[\'REQUEST_TIME\'] = '.$_SERVER['REQUEST_TIME'].'<br />';
	echo '$_SERVER[\'QUERY_STRING\'] = '.$_SERVER['QUERY_STRING'].'<br />';
	echo '$_SERVER[\'DOCUMENT_ROOT\'] = '.$_SERVER['DOCUMENT_ROOT'].'<br />';
	echo '$_SERVER[\'HTTP_ACCEPT\'] = '.$_SERVER['HTTP_ACCEPT'].'<br />';
	echo '$_SERVER[\'HTTP_ACCEPT_CHARSET\'] = '.$_SERVER['HTTP_ACCEPT_CHARSET'].'<br />';
	echo '$_SERVER[\'HTTP_ACCEPT_ENCODING\'] = '.$_SERVER['HTTP_ACCEPT_ENCODING'].'<br />';
	echo '$_SERVER[\'HTTP_ACCEPT_LANGUAGE\'] = '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'<br />';
	echo '$_SERVER[\'HTTP_CONNECTION\'] = '.$_SERVER['HTTP_CONNECTION'].'<br />';
	echo '$_SERVER[\'HTTP_REFERER\'] = '.$_SERVER['HTTP_REFERER'].'<br />';
	echo '$_SERVER[\'HTTP_USER_AGENT\'] = '.$_SERVER['HTTP_USER_AGENT'].'<br />';
	echo '$_SERVER[\'HTTPS\'] = '.$_SERVER['HTTPS'].'<br />';
	echo '$_SERVER[\'REMOTE_ADDR\'] = '.$_SERVER['REMOTE_ADDR'].'<br />';
	echo '$_SERVER[\'REMOTE_HOST\'] = '.$_SERVER['REMOTE_HOST'].'<br />';
	echo '$_SERVER[\'REMOTE_PORT\'] = '.$_SERVER['REMOTE_PORT'].'<br />';
	echo '$_SERVER[\'SCRIPT_FILENAME\'] = '.$_SERVER['SCRIPT_FILENAME'].'<br />';
	echo '$_SERVER[\'SERVER_ADMIN\'] = '.$_SERVER['SERVER_ADMIN'].'<br />';
	echo '$_SERVER[\'SERVER_PORT\'] = '.$_SERVER['SERVER_PORT'].'<br />';
	echo '$_SERVER[\'SERVER_SIGNATURE\'] = '.$_SERVER['SERVER_SIGNATURE'].'<br />';
	echo '$_SERVER[\'SCRIPT_NAME\'] = '.$_SERVER['SCRIPT_NAME'].'<br />';
	echo '$_SERVER[\'REQUEST_URI\'] = '.$_SERVER['REQUEST_URI'].'<br />';
	echo '$_SERVER[\'PHP_AUTH_DIGEST\'] = '.$_SERVER['PHP_AUTH_DIGEST'].'<br />';
	echo '$_SERVER[\'PHP_AUTH_USER\'] = '.$_SERVER['PHP_AUTH_USER'].'<br />';
	echo '$_SERVER[\'PHP_AUTH_PW\'] = '.$_SERVER['PHP_AUTH_PW'].'<br />';
	echo '$_SERVER[\'AUTH_TYPE\'] = '.$_SERVER['AUTH_TYPE'].'<br />';
	echo '$_SERVER[\'PATH_INFO\'] = '.$_SERVER['PATH_INFO'].'<br />';
	echo '$_SERVER[\'ORIG_PATH_INFO\'] = '.$_SERVER['ORIG_PATH_INFO'].'<br />';
	
	echo '$_GET[\'nama\'] = '.$_GET['nama'].'<br />';
	
	echo '$_POST[\'nama\'] = '.$_POST['nama'].'<br />';
	
	echo '$_FILES[\'name\'] = '.$_FILES['name'].'<br />';
	echo '$_FILES[\'type\'] = '.$_FILES['type'].'<br />';
	echo '$_FILES[\'tmp_name\'] = '.$_FILES['tmp_name'].'<br />';
	echo '$_FILES[\'error\'] = '.$_FILES['error'].'<br />';
	echo '$_FILES[\'size\'] = '.$_FILES['size'].'<br />';
	
	echo '$_REQUEST[\'nama\'] = '.$_REQUEST['nama'].'<br />';
	
	$_SESSION['login']='sessionku';
	echo '$_SESSION[\'login\'] = '.$_SESSION['login'].'<br />';
	
	echo '$_ENV[\'user\'] = '.$_ENV['user'].'<br />';
	
	$_COOKIE['nama']='cookie ku';
	echo '$_COOKIE[\'nama\'] = '.$_COOKIE['nama'].'<br />';

	echo '$php_errormsg = '.$php_errormsg.'<br />';
	echo '$http_response_header = '.$http_response_header.'<br />';
	echo '$argc = '.$argc.'<br />';
	echo '$argv = '.$argv.'<br />';
?>
</body>
</html>