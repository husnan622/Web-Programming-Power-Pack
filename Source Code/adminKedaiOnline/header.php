<?php require_once("Connections\conn.php"); ?>
<?php	
	if(!isset($_SESSION))
		session_start();		
?>
<div id="header_container">
  <div id="header_top">
    <div id="header_kiri">
      <div id="logo" onclick="window.location='.';"></div>
    </div>
    <div id="header_kanan">
      <div><span>User aktif: <?php echo $_SESSION[$app_code."username"];?></span>, <a href="logout.php">logout</a></div>
    </div>
  </div>
  <div class="clear"></div>
  <div id="header_bottom">
    <div id="menu">
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="kategori.html">Kategori</a></li>
        <li><a href="produk.html">Produk</a></li>
        <li><a href="member.html">Member</a></li>
        <li><a href="user.html">User</a></li>
      </ul>
    </div>
  </div>
</div>