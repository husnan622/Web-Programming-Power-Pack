<?php
	$array = array(1,'2',true);
	$array2 = array('satu' => 1, '2' => 'dua', 3 => "tiga");
	$array3 = array('array' => array(1,2,3), 'matrix' => array(4,5,6));
	$array4 = array('dua' => array('arr' => 2, 'arr2' => 3), 'tiga' => array('arr' => 2, 'arr2' => 3));

	echo '$array[1] = '.$array[1];
	echo '<br />';
	echo '$array2[\'satu\'] = '.$array2['satu'];
	echo '<br />';
	echo '$array3[\'array\'][2] = '.$array3['matrix'][2];
	echo '<br />';
	echo '$array4[\'dua\'][\'arr\'] = '.$array4['dua']['arr'];
	
?>
