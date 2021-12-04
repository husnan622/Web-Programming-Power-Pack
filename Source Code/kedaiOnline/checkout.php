 <?php require_once("Connections\conn.php"); ?>
<?php
 		if(!isset($_SESSION))
			session_start();
		
		if(!isset($_SESSION['cart_token']))
			$_SESSION['cart_token']= uniqid();
		
		$back = "checkout.php";
		$goto = "success.php";
		$action = "otentikasi.php?back=".$back."&goto=".$goto;
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
	var dsCart = new Spry.Data.XMLDataSet("rsxml.php?tabel=cart_view", "kedaionline_db/cart_view[cart_token='<?php echo $_SESSION['cart_token'];?>']",{sortOnLoad:"true",sortOrderOnLoad:"ascending", useCache:false});
	var params = new Spry.Utils.getLocationParamsAsObject();
	
	dsCart.filter(formatCurrency);
	
	dsProduk.addObserver({ 
		onPostLoad: function(ds, type) {
			dsProduk.setCurrentRow(params.prd);
			dsProdukImage.setCurrentRow(params.prd);
		}
	});
		
	function getSum(){
		var sum = parseInt(0);
		for(i=0;i<dsCart.getRowCount();i++){
			var curr = dsCart.getRowByID(i);
			sum += parseInt(toDecimal(curr['total']));				
		}
			
		return toCurrency(sum);
	}
	   
	function cartCallback(req){
		dsCart.loadData();
	}	
	   
	function changeValue(value){
		var curr = dsCart.getCurrentRow();
		curr['qty']=value;			
	}
		
	function updateCart(id){
		dsCart.setCurrentRow(id);
		var curr = dsCart.getCurrentRow();
		var url = "/kedaiOnline/rsquery.php?tabel=cart&cart_token=<?php echo $_SESSION['cart_token'];?>&produk_token="+curr['produk_token']+"&qty="+curr['qty']+"&harga="+toDecimal(curr['harga'])+"&for=add";
		Spry.Utils.loadURL("post",url,true,cartCallback);
	} 
		
	function submitCheckout(){
		window.location = "<?php echo $action; ?>";
	}
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
  	<div id="checkout_container" spry:region="dsCart dsProduk">
      <table>
        <thead>
          <tr>
            <th>Id.</th>
            <th>Nama</th>
            <th>Qty</th>
            <th class="nilai">Harga</th>
            <th class="nilai">Total</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
        	<tr>
            	<td class="nilai" colspan="4"><span>Total:</span></td>
                <td class="nilai">{function::getSum}</td>
                <td></td>
            </tr>
            <tr>
            	<td colspan="6"><button onclick="submitCheckout(); return false;">Check Out</button></td>
            </tr>
        </tfoot>
        <tbody>
        	<tr spry:repeat="dsCart" spry:setrow="dsCart">
            	<td spry:repeat="dsProduk" spry:test="'{dsProduk::token}'=='{dsCart::produk_token}'">{dsProduk::id}</td>
                <td spry:repeat="dsProduk" spry:test="'{dsProduk::token}'=='{dsCart::produk_token}'">{dsProduk::nama}</td>
                <td><input type="text" id="cart_qty" name="cart_qty" value="{qty}" maxlength="3" max="3" onblur="changeValue(this.value);" /></td>
                <td class="nilai">{harga}</td>
                <td class="nilai">{total}</td>
                <td><button onclick="updateCart({dsCart::ds_RowID}); return false;">Update</button></td>
            </tr>
        </tbody>
      </table>
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
