<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan Ternary</title>
</head>

<body>
<?php
	$a = 1;
	$b = 2;
	
	$c = ($a<$b) ? $a : $b;
	echo '$a = '.$a.'<br/>';
	echo '$b = '.$b.'<br/><br/>';	
	echo 'Ternary:'.'<br/>';
	echo '$c = ($a < $b) ? $a : $b'.'<br/>';
	echo '$c = '.$c;
?>
</body>
</html>