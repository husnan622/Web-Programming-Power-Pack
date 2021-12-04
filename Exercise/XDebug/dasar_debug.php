<?php
	setcookie("userlogin","PHP",time()+1800);
	setrawcookie("passlogin","MYSQL",time()+1800);
	
	echo $_COOKIE["userlogin"];
	echo $_COOKIE["passlogin"];
?>
<?php
	xdebug_start_code_coverage();
	function fix_string($a)
    {
        printf(nl2br("Alamat file : %s\n"),xdebug_call_file());
		printf(nl2br("Baris : %s\n"),xdebug_call_line());
		printf(nl2br("Nama function : %s\n"),xdebug_call_function());
    }
	
    $ret = fix_string(array('XDebug'));
	var_dump(xdebug_get_code_coverage());
	
	echo "Suatu teks";
	echo("Suatu teks");
	
	$teks="Suatu tulisan";
	$teks2="tulisan lainnya";
	echo $teks,$teks2;
	
	$tag = <<<END This uses the "here document" syntax to output multiple lines with $variable interpolation. Note that the here document terminator must appear on a line with just a semicolon. no extra whitespace! END;
	
	echo $tag;
?>