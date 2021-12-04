<div id="header_container">
    <div id="header_logo"></div>
    <div id="header_user">
      <div id="user_info">
        <?php if(isset($_SESSION["member_login"])) : ?>
        <div><?php echo $_SESSION["member_nama"];?> | <a href="logout.php">Logout</a></div>
        <?php else: ?>
        <?php if(strpos($_SERVER['REQUEST_URI'],"otentikasi.php") !== false) : ?>
        <div>Registrasi | Login</div>
        <?php else : ?>
        <?php $temp = $_SERVER['REQUEST_URI']; ?>
        <?php $back = ($temp[strlen($temp)-1] === '/') ? "." : $temp; ?> 
        <div><a href="otentikasi.php?back=<?php echo $back; ?>">Registrasi | Login</a> </div>
        <?php endif; ?>
        
        <?php endif; ?>
      </div>
    </div>
    <div id="header_tengah"></div>
    <!-- Div Spry Tooltip -->
    <div id="home_tooltip">
        <div>
            <p>Tekan untuk kembali ke Halaman Utama</p>
        </div>
    </div>
    <!-- Spry Tooltip -->
    <script type="text/javascript">
        var home_logo =new Spry.Widget.Tooltip("home_tooltip","#header_logo",{useEffect:"grow"});
        
        Spry.Utils.addEventListener('header_logo','click',function(){
            window.location = ".";
        },true);
    </script>
</div>