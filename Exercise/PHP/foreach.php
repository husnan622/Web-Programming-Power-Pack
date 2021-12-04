<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan ForEach</title>
</head>

<body>
	<?php $kata = array('satu', 'dua', 'tiga', 'empat', 'lima');
		foreach($kata as $a)
			echo $a."<br />";	
	?>
    
    <?php foreach($kata as $a): ?>
			<b>Nilai $a = <?php echo $a ?>;</b><br />
	<?php endforeach; ?>	
</body>
</html>
