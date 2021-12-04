<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan Interface</title>
</head>

<body>
	<?php
		interface SuatuInterface
		{
			function SuatuMetode();
			function SuatuMetodeLain();		
		}			
		
		class SuatuKelas implements SuatuInterface
		{
			function SuatuMetode(){
				echo 'SuatuMetode dijalankan'.'<br />';
			}
			
			function SuatuMetodeLain(){
				echo 'Suatu Metode Lain dijalankan'.'<br />';
			}
			
			function SuatuMetodeLainnya(){
				echo 'Suatu Metode Lainnya dijalankan'.'<br />';
			}		
		}
		
		$kelas = new SuatuKelas();
		$kelas->SuatuMetode();
		$kelas->SuatuMetodeLain();
		$kelas->SuatuMetodeLainnya();
	?>
</body>
</html>
