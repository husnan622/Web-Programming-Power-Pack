<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan For</title>
</head>

<body>
	<?php
		for($a=0;$a<=10;$a=$a+3)
			echo $a."<br />";	
	?>
    
    <?php for($a=0;$a<=10;$a++): ?>
			<b>Nilai $a = <?php echo $a ?>;</b><br />
	<?php endfor; ?>	
</body>
</html>
