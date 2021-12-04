<?php
	$xml = simplexml_load_file("../Spry/SampelData.xml");
	echo ((string)$xml->barang[0]->nama)."\"slash\"";
	$addslash = addslashes("kopet");
	echo "addslash function result : ".$addslash;
?>