<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan Goto</title>
</head>

<body>
<?php
	$a=0;
	if($a==0)
		goto proses_a;
	else
		goto proses_b;
		
	proses_a:
		echo 'Proses a sedang dijalankan';
	proses_b:
		echo 'Proses b sedang dijalankan';
?>
</body>
</html>