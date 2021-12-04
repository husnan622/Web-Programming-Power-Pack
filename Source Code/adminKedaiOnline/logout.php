<?php require_once("Connections\conn.php");?>
<?php
	session_start();
	
	unset($_SESSION[$app_code."username"]);
	session_destroy();
	
	$arr_ref = explode("/",$_SERVER['HTTP_REFERER']);
	$ref = $arr_ref[count($arr_ref)-1];
	
	if(strpos($ref,"kategori.html")!== false)
		$back = "kategori.html";
	elseif(strpos($ref,"produk.html")!== false)
		$back = "produk.html";
	elseif(strpos($ref,"member.html")!== false)
		$back = "member.html";
	elseif(strpos($ref,"user.html")!== false)
		$back = "user.html";
	else
		$back = ".";
	
	header("location: ".$back);
	exit;
?>
