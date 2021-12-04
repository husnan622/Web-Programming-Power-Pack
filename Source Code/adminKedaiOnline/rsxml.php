<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conn, $conn);
$query_rs = "SELECT * FROM tbl_cart";
$rs = mysql_query($query_rs, $conn) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);
$totalRows_rs = mysql_num_rows($rs);
	// Penyaringan Query String
	if(isset($_SERVER['QUERY_STRING'])){
		if(isset($_REQUEST['tabel'])){
			$tabel=$_REQUEST['tabel'];
		}

		if(isset($_REQUEST['id'])){
			$id=$_REQUEST['id'];
		}
		
		if(!isset($tabel))
			exit;		
	}	
	else
		exit;

	mysql_select_db($database_conn, $conn);
	if(isset($tabel) && isset($id))
		$query_rs = "SELECT * FROM tbl_".$tabel." WHERE id=".$id;
	elseif(isset($tabel))
		$query_rs = "SELECT * FROM tbl_".$tabel;
		
	$rs = mysql_query($query_rs, $conn) or die(mysql_error());
	$row_rs = mysql_fetch_assoc($rs);
	$totalRows_rs = mysql_num_rows($rs);
?>
<?php
	header('Content-type: text/xml');
	header('Pragma: public');        
	header('Cache-control: private');
	header('Expires: -1');
?>
<?php echo('<?xml version="1.0" encoding="utf-8"?>'); ?>
<<?php echo $database_conn; ?>>
<?php if($totalRows_rs > 0): ?>
<?php do { ?>
<<?php echo $tabel; ?>>
		<?php foreach ($row_rs as $column=>$value): ?>
		<<?php echo $column; ?>><![CDATA[<?php echo $row_rs[$column]; ?>]]></<?php echo $column; ?>>
		<?php endforeach; ?>
</<?php echo $tabel; ?>>
<?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
<?php endif; ?>
</<?php echo $database_conn; ?>>
<?php
mysql_free_result($rs);
?>