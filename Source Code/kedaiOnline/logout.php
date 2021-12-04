<?php
	if(isset($_SERVER['QUERY_STRING']))
		$back = $_REQUEST['back'];

	if(!isset($_SESSION))
		session_start();
	
	if(isset($_SESSION['member_login'])){
		unset($_SESSION['member_login']);
		unset($_SESSION['member_token']);
	}
		
	header("location: ".(empty($back) ? "." : $back));
	exit;
?>