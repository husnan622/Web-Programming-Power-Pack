<?php 
	if(!isset($_SESSION))
		session_start();
?>

<script type="text/javascript" language="javascript">
	var dsCart = new Spry.Data.XMLDataSet("rsxml.php?tabel=cart_view", "kedaionline_db/cart_view[cart_token='<?php echo $_SESSION['cart_token'] ?>']",{sortOnLoad:"true",useCache:false});
	
	dsCart.filter(formatCurrency);
</script>
<div id="cart_container">
  <div class="cart_items" spry:region="dsCart dsProduk">
      <table>
        <caption>Kantong Belanja Anda:</caption>
        <thead>
          <tr>
            <th>Id.</th>
            <th>Nama</th>
            <th>Qty</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <td colspan="2"><button onclick="Checkout();">Check Out</button></td>
            <td colspan="2"><button onclick="emptyCart(); return false;">Empty List</button></td>
          </tr>
        </tfoot>
        <tbody id="item_list">
          <tr spry:repeat="dsCart">
            <td spry:repeat="dsProduk" spry:test="'{dsCart::produk_token}'=='{dsProduk::token}'">{dsProduk::id}</td>
            <td spry:repeat="dsProduk" spry:test="'{dsCart::produk_token}'=='{dsProduk::token}'">{dsProduk::nama}</td>
            <td>{qty}</td>
            <td class="nilai">{harga}</td>
          </tr>
        </tbody>
      </table>
  </div>
</div>
<script type="text/javascript" language="javascript">
	function emptyCart(){
		if(confirm("Anda yakin untuk menghapus Kantong Belanja?")==true)
		{
			var url = "rsquery.php?tabel=cart&cart_token=<?php echo $_SESSION['cart_token'];?>&for=rem";
			Spry.Utils.loadURL("post",url,true,cartCallback);
		}
	}
	
	function Checkout(){
		window.location = "checkout.php";
	}
	
	function cartCallback(req){
		dsCart.loadData();
	}	
</script>