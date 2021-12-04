<?php require_once("Connections/conn.php");?>
<?php
	ob_start();
	
	session_start();
	if(isset($_SESSION[$app_code."username"])){
		header("location: index.html");
		exit;
	}
	
	$action="otentikasi.php?".$_SERVER['QUERY_STRING'];
	
    if(isset($_POST['login_user']) && isset($_POST['login_pass'])){
		$query = " SELECT token,username,password FROM tbl_user WHERE username='".$_POST['login_user']."' ";
		mysql_select_db($database_conn);
		$result = mysql_query($query);
		
		if($result){
			$row = mysql_fetch_assoc($result);
			$username = GetSQLValueString($row["username"],"text");
			$token = GetSQLValueString($row["token"],"text");
			$pass = GetSQLValueString($_POST["login_pass"],"text");
			
			if(md5($username.$token.$pass)==$row["password"]){
				$_SESSION[$app_code."username"]=$row["username"];
				
				$back_page='index.html';
				if(isset($_REQUEST['back'])) 
					$back_page = $_REQUEST['back'];
				
				header("location: ".$back_page);
				exit;	
			}
		}		
    }
	ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<script src="scriptstyle.js" type="text/javascript"></script>
</head>
<body>
<div id="loginbox">
  <form action="<?php echo $action; ?>" method="post" enctype="application/x-www-form-urlencoded" name="form_login">
    <div id="logo"></div>
    <div id="loginform">
        <span id="spryusername">
        <label for="login_user">Username</label>
        <input type="text" name="login_user" id="login_user" />
        <span class="textfieldRequiredMsg">*</span></span><br />
        <span id="sprypassword">
        <label for="login_pass">Password</label>
        <input type="password" name="login_pass" id="login_pass" />
        <span class="passwordRequiredMsg">*</span></span><br />
        <div id="kontrol">
          <input name="btn_submit" type="submit" value="Login" />
          <input name="btn_reset" type="reset" value="Reset" />
        </div>
     </div>
  </form>
</div>
<script type="text/javascript">
	var spryusername = new Spry.Widget.ValidationTextField("spryusername");
	var sprypassword = new Spry.Widget.ValidationPassword("sprypassword");	
</script>
</body>
</html>
