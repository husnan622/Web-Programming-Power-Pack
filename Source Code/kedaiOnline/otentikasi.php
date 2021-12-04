 <?php require_once("Connections\conn.php"); ?>
 <?php		
 		if(!isset($_SESSION))
			session_start();
			
		if(isset($_REQUEST['back']))
			$back = $_REQUEST['back'];
		
		if(isset($_REQUEST['goto']))
			$goto = $_REQUEST['goto'];
		
		if(isset($_SESSION['member_login'])){
			if(!isset($back))
				$back = ".";
		
			if(!isset($goto))
				$goto = "."; 
		
			if(strpos($_SERVER['HTTP_REFERER'],"checkout.php"))
				header('location: '.$goto);
			else
				header('location: '.$back);
		
			exit;
		}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kedai Online</title>
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColLiqLtHdr #sidebar1 { padding-top: 30px; }
.twoColLiqLtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<script type="text/javascript" src="scriptstyle.js"></script>
<script type="text/javascript">
	var dsKategori = new Spry.Data.XMLDataSet("rsxml.php?tabel=kategori", "kedaionline_db/kategori",{useCache:false});
	var dsProduk = new Spry.Data.XMLDataSet("rsxml.php?tabel=produk", "kedaionline_db/produk",{useCache:false});
	var dsProdukImage = new Spry.Data.XMLDataSet("rsxml.php?tabel=produk_image", "kedaionline_db/produk_image",{useCache:false});
	var params = new Spry.Utils.getLocationParamsAsObject();
	
	dsProduk.addObserver({ 
		onPostLoad: function(ds, type) {
			dsProduk.setCurrentRow(params.prd);
			dsProdukImage.setCurrentRow(params.prd);
	}
});
</script>
</head>

<body class="twoColLiqLtHdr">

<div id="container"> 
  <div id="header">
    <?php include_once("header.php"); ?>
  <!-- end #header --></div>
  <div id="sidebar1">
    <?php include_once("katalog.php"); ?>
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
   <?php
   	$action = str_replace('&register','',str_replace('&login','',$_SERVER['REQUEST_URI']));
	$action = str_replace('?register','',str_replace('?login','',$action));
	
	$action_login = (isset($_SERVER['HTTP_REFERER']) ? '&login' : '?login');
	$action_register = (isset($_SERVER['HTTP_REFERER']) ? '&register' : '?register');
	$back="";
	$goto="";
			
	if(isset($_REQUEST['login'])){
		if($_POST['login_user']!='' && $_POST['login_pass']!=''){			
			$query = " SELECT token,id,nama,email,password FROM tbl_member ";
			$query.= " WHERE email=".GetSQLValueString($_POST['login_user'],"text");
			
			mysql_select_db($database_conn);
			$result = mysql_query($query,$conn);
			$row = mysql_fetch_assoc($result);
			$rowcount = mysql_num_rows($result);
			
			if($rowcount>0){
				do{
					$token = $row['token'];
					$nama = GetSQLValueString($row['nama'],"text");
					$email = GetSQLValueString($row['email'],"text");
					$password = GetSQLValueString($_POST['login_pass'],"text");
					
					if(md5($token.$email.$nama.$password)== $row['password']){
						$_SESSION['member_token']=$row['token'];
						$_SESSION['member_login']=$_POST['login_user'];
						$_SESSION['member_nama']=$row['nama'];
						
						header("location: ".(empty($goto) ? "." : $goto));
						exit;
					}
				}while($row = mysql_fetch_assoc($result));			
			}
		}
	}
	
	if(isset($_REQUEST['register'])){
		$query = " SELECT token FROM tbl_member WHERE email=".GetSQLValueString($_POST['member_email'],"text");
		mysql_select_db($database_conn);		
		$result = mysql_query($query,$conn);
		$rowcount = mysql_num_rows($result);
		
		$token = uniqid();
		$email = GetSQLValueString($_POST['member_email'],"text");
		$nama = GetSQLValueString($_POST['member_nama'],"text");
		$password = GetSQLValueString($_POST['member_password'],"text");
		
		$pass = md5($token.$email.$nama.$password);
						
		if(!$rowcount>0){
			
			$query = " INSERT INTO tbl_member (token,no_id,nama,alamat,email,password) ";
			$query.= " VALUES ";
			$query.= " (".GetSQLValueString($token,"text").", ";
			$query.= GetSQLValueString($_POST['member_noid'],"text").", ";
			$query.= $nama.", ";
			$query.= GetSQLValueString($_POST['member_alamat'],"text").", ";
			$query.= $email.", ";
			$query.= GetSQLValueString($pass,"text").") ";
			
			$result = mysql_query($query,$conn) or die(var_dump($query));			
			
			$_SESSION['member_token']=$token;
			$_SESSION['member_login']=$_POST['member_email'];
			$_SESSION['member_nama']=$_POST['member_nama'];
			$_SESSION['member_pass']=$_POST['member_password'];
			$_SESSION['member_pass_gen']=$pass;
									
			header("location: ".(empty($goto) ? "." : $goto));
			exit;
		}		
	}	
?>
<div id="container_otentikasi">
	<div id="left_otentikasi">
    	<div id="login">
        	<h3>Login</h3>
            <form id="form_login" name="form_login" action="<?php echo $action.$action_login; ?>" method="post" >
            	<span id="login_username">
                    <label for="login_user">Email</label>
                    <input id="login_user" name="login_user" type="text" />
                    <span class="textfieldRequiredMsg">*</span>
                </span><br />
                <span id="login_password">
                	<label for="login_pass">Password</label>
                    <input id="login_pass" name="login_pass" type="password" />
                	<span class="passwordRequiredMsg">*</span>
                </span><br />                
                <div class="kontrol">
                	<input id="btn_submit" name="btn_submit" type="submit" value="Login" />
                    <input id="btn_reset" name="btn_reset" type="reset" value="Reset"  />
                </div>
            </form>
        </div>
    </div>
    <div id="right_otentikasi">
    	<div id="registrasi">
        	<h3>Registrasi Member</h3>
            <p>Silakan isi form data dibawah ini:</p>
        	<form id="form_register" name="form_register" action="<?php echo $action.$action_register; ?>" method="post">
            	<input id="member_id" name="member_id" type="hidden" />
            	<fieldset>
                	<legend>Informasi Login</legend>
                    <span id="reg_email">
                    	<label for="member_email">Email</label>
                        <input id="member_email" name="member_email" type="text" />
                        <span class="textfieldRequiredMsg">*</span>
                    </span><br />
                    <span id="reg_password">
                    	<label for="member_password">Password</label>
                        <input id="member_password" name="member_password" type="password" />
                        <span class="passwordRequiredMsg">*</span>
                    </span><br />
                    <span id="reg_verify">
                    	<label for="member_password_verify">Verifikasi</label>
                        <input id="member_password_verify" name="member_password_verify" type="password" />
                        <span class="confirmRequiredMsg">*</span>
                        <span class="confirmInvalidMsg">*</span>
                    </span><br />
                </fieldset>
                <fieldset>
                	<legend>Identitas</legend>
                    <span id="reg_noid">
                    	<label for="member_noid">No.Identitas</label>
                        <input id="member_noid" name="member_noid" type="text" />
                		<span class="textfieldRequiredMsg">*</span>
                    </span><br />
            		<span id="reg_nama">
                    	<label for="member_nama">Nama Lengkap</label>
                        <input id="member_nama" name="member_nama" type="text" />
                        <span class="textfieldRequiredMsg">*</span>
                    </span><br />
                    <span id="reg_alamat">
                    	<label for="member_alamat">Alamat</label>
                        <textarea id="member_alamat" name="member_alamat" cols="30" rows="3"></textarea>
                        <span class="textareaRequiredMsg">*</span>
                    </span><br />
                </fieldset>
                <div class="kontrol">
                	<input id="btn_submit" name="btn_submit" type="submit" value="Register"  />
                    <input id="btn_reset" name="btn_reset" type="reset" value="Reset"  />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	var loginusername = new Spry.Widget.ValidationTextField("login_username");
	var loginpassword = new Spry.Widget.ValidationPassword("login_password");
	
	var regemail = new Spry.Widget.ValidationTextField("reg_email");
	var regpassword = new Spry.Widget.ValidationPassword("reg_password");
	var regverify = new Spry.Widget.ValidationConfirm("reg_verify","member_password");
	
	var regnoid = new Spry.Widget.ValidationTextField("reg_noid");
	var regnama = new Spry.Widget.ValidationTextField("reg_nama");
	var regalamat = new Spry.Widget.ValidationTextarea("reg_alamat");
	
	function submitLoginCallback(req){
		alert(req.xhRequest.responseText);
	}
	
	function submitRegistrasiCallback(req){
		alert(req.xhRequest.responseText);
	}
</script>
	<!-- end #mainContent -->
</div>

	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <?php include_once("footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
