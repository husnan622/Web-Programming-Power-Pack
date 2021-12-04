<?php require_once("Connections\conn.php"); ?>
<?php
	if(!isset($_SESSION))
		session_start();
	
	if(!function_exists('execQuery')){
		function execQuery($query,$db,$cn){
			mysql_select_db($db,$cn);
			return mysql_query($query,$cn);
		}
	}
	
	if(isset($_SERVER['HTTP_REFERER'])){
		// Simpan Header Member Checkout
		$token = uniqid();
		$query = " INSERT INTO tbl_member_checkout(token,member_token) ";
		$query.= " VALUES ";
		$query.= " (".GetSQLValueString($token,"text"). ", ".GetSQLValueString($_SESSION['member_token'],"text").")";
		
		if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
		
		// Simpan Detil Member Checkout 
		$query = " SELECT cart_token,produk_token, qty,harga FROM tbl_cart ";
		$query.= " WHERE cart_token = ".GetSQLValueString($_SESSION['cart_token'],"text");
		
		$result = execQuery($query,$database_conn,$conn);
		$row = mysql_fetch_assoc($result);
				
		do{
			$query = " INSERT INTO tbl_member_checkout_produk (token,produk_token,qty,harga) ";
			$query.= " VALUES ";
			$query.= " (".GetSQLValueString($token,"text").", ";
			$query.= GetSQLValueString($row['produk_token'],"text").",";
			$query.= GetSQLValueString($row['qty'],"int").", ";
			$query.= GetSQLValueString($row['harga'],"double").")";
			
			if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
		}while($row = mysql_fetch_assoc($result));
		
		// Hapus Cart
		$query = " DELETE FROM tbl_cart WHERE cart_token=".GetSQLValueString($_SESSION['cart_token'],"text");
		
		if(!execQuery($query,$database_conn,$conn))
		
		unset($_SESSION['cart_token']); 
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
   <div id="success_view">
        <h3>Checkout Sukses</h3><br />
        <h4>Proses Checkout selesai</h4>
    </div>
	<!-- end #mainContent -->
  </div>

	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <?php include_once("footer.php"); ?>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
