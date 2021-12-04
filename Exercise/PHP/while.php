<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan While</title>
</head>

<body>
	<?php
		$a=0;		
		while($a<=10){
			echo $a."<br />";
			$a++;
		}	
	?>
    
    <?php $a=0; ?>
    <?php while($a<=10): ?>
			<b>Nilai $a = <?php echo $a ?>;</b><br />
            <?php $a++; ?>
	<?php endwhile; ?>
</body>
</html>
