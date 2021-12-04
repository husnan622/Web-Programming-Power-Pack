<?php
	$a="hello";
	$b=1;
	switch($a){
		case "hallo":
			echo "they say hallo<br/>";
			break;
		case "hello":
			echo "they say hello<br/>";
			break;
		default:
			echo "i don't know what did you say<br/>";
			break;		
	}
	
	switch($b):
		case 1:
			echo '$b = 1<br/>';
			break;
		case 2:
			echo '$b = 2<br/>';
			break;
		case 3:
			echo '$b = 3<br/>';
			break;
		default:
			echo '$b = 0<br/>';
			break;
	endswitch;
?>


<html>
<head>
	<title>Latihan Switch</title>
</head>
<body>
	<?php $a=2; ?>
	<?php switch($a): case 0: ?>
    	<b>Ini pernyataan untuk $a=0</b><br />
    <?php break; ?>
    <?php case 1: ?>
    	<b>Ini pernyataan untuk $a=1</b><br />
    <?php break; ?>
    <?php default: ?>
    	<b>Ini pernyataan untuk default</b><br />
    <?php break; ?>
    <?php endswitch; ?>
</body>
</html>
