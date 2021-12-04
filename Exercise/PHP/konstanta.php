<?php
	// contoh DEFINE
	define("MAX_NUMBER",9);	
	echo MAX_NUMBER.'<br />';

	// contoh MAGIC 
	echo __DIR__.'<br />';
	
	const url = 'http://localhost';
	
	echo url.'<br />';
	echo constant('url');
?>