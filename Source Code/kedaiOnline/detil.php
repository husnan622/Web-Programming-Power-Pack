<?php if(isset($_REQUEST['kat']) && isset($_REQUEST['prd'])) : ?>
<div id="produk_container" spry:detailregion="dsProduk">
  <div id="produk_foto">
    <div id="selectedFoto"><img id="selFoto" /></div>
    <div class="fotokontrol">
      <div class="listfoto">
        <div class="container_foto">
        	<img class="foto" src="viewer.php?source=bin&amp;id={token}&amp;index=0" width="50px" height="50px" onclick="showImage(this);" />
        </div>
        <div class="container_foto">
        	<img class="foto" src="viewer.php?source=bin&amp;id={token}&amp;index=1" width="50px" height="50px" onclick="showImage(this);" />
        </div>
        <div class="container_foto">
        	<img class="foto" src="viewer.php?source=bin&amp;id={token}&amp;index=2" width="50px" height="50px" onclick="showImage(this);" />
        </div>
      </div>
    </div>
  </div>
  <div></div>
  <div id="produk_deskripsi" spry:choose="choose">
        <ul spry:when="'{harga_spesial}' != '0'">
          <li class="nama">{nama}</li>
          <li class="deskripsi">{deskripsi}</li>
          <li class="coret harga">{harga}</li>
          <li class="harga">{harga_spesial}</li>
          <li><input type="button" id="btn_addtocart" onclick="addToCart();" value="Tambah" /></li>
        </ul>
        <ul spry:default="default">
          <li class="nama">{nama}</li>
          <li class="deskripsi">{deskripsi}</li>
          <li class="harga">{harga}</li>
          <li class="hide">{harga_spesial}</li>
          <li><input type="button" id="btn_addtocart" onclick="addToCart();" value="Tambah" /></li>
        </ul>
  </div>
</div>
<script type="text/javascript">
	function formatProdukHarga(ds,row,row_number){
		var harga = parseInt(row['harga'].replace(',',''));
		var harga_spesial = parseInt(row['harga_spesial'].replace(',',''));
		
		row['harga']=toCurrency(harga);
		row['harga_spesial']=toCurrency(harga_spesial);
			
		return row;
	}
	
	dsProduk.filter(formatProdukHarga);
		
	function setImage(imgPath, width, height){
		var img = document.getElementById('selFoto');
		
		gImageLoader = new Image();
		gImageLoader.onload = function(){
			img.src = gImageLoader.src;
			img.width=width;
			img.height=height;
			
			gImageLoader = null;		
		}
		
		gImageLoader.src = imgPath;
	}
	
	function showImage(img){
		var path = img.src;
		var width = 200;
		var height = 100;
		
		setImage(path,width,height);
	}
	
	function addToCart(){
		var curr = dsProduk.getCurrentRow();
		var url = "rsquery.php?tabel=cart&cart_token=<?php echo $_SESSION['cart_token'];?>&produk_token="+curr['token']+"&qty=-1&harga="+(toDecimal(curr['harga_spesial']) > 0 ? toDecimal(curr['harga_spesial']) : toDecimal(curr['harga']))+"&for=add";
		Spry.Utils.loadURL("post",url,true,cartCallback);
	}	
</script>
<?php endif; ?>