<?php require_once('Connections/conn.php');?>
<?php	
	if(!function_exists('execQuery')){
		function execQuery($query,$db,$cn){
			mysql_select_db($db,$cn);
			return mysql_query($query,$cn);
		}
	}
	
	if(isset($_SERVER['QUERY_STRING'])){
		if(isset($_REQUEST['tabel'])){
			switch($_REQUEST['tabel']){
					case "cart":
						if($_REQUEST['for']=='add'){
							if(isset($_REQUEST['cart_token']) && isset($_REQUEST['produk_token']) && isset($_REQUEST['qty']) && isset($_REQUEST['harga'])){
								$query = " SELECT cart_token, produk_token, qty, harga FROM tbl_cart ";
								$query.= " WHERE cart_token=".GetSQLValueString($_REQUEST['cart_token'],"text");
								$query.= " 		AND produk_token=".GetSQLValueString($_REQUEST['produk_token'],"text");
								
								$result = execQuery($query,$database_conn,$conn);
								$row_count = mysql_num_rows($result);
								
								if($row_count==0){
									$query = " INSERT INTO tbl_cart (cart_token, produk_token, qty, harga) ";
									$query.= " VALUES ";
									$query.= " (".GetSQLValueString($_REQUEST['cart_token'],"text").", ";
									$query.= GetSQLValueString($_REQUEST['produk_token'],"text").", ";
									$query.= " 1, ";
									$query.= GetSQLValueString($_REQUEST['harga'],"double")." )";

									if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));							
								}
								else{
									$row = mysql_fetch_assoc($result);
									
									do{
										if($_REQUEST['qty']==0)
											$query = " DELETE FROM tbl_cart ";
										elseif($_REQUEST['qty'] > 0)
											$query = " UPDATE tbl_cart SET qty=".GetSQLValueString($_REQUEST['qty'],"int");
										else
											$query = " UPDATE tbl_cart SET qty = qty + 1 ";
										
										$query.= " WHERE cart_token=".GetSQLValueString($_REQUEST['cart_token'],"text");
										$query.= " 		AND produk_token=".GetSQLValueString($_REQUEST['produk_token'],"text");							
										
										if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
																			
									}while($row = mysql_fetch_assoc($result));
								}							
							} 
						}
						elseif($_REQUEST['for']=='rem'){
							if(isset($_REQUEST['cart_token'])){
								$query = " DELETE FROM tbl_cart ";
								
								if(isset($_REQUEST['produk_token'])){								
									$query.= " WHERE cart_token=".GetSQLValueString($_REQUEST['cart_token'],"text");
									$query.= " 		AND produk_token=".GetSQLValueString($_REQUEST['produk_token'],"text");	
								}
								else
									$query.=" WHERE cart_token=".GetSQLValueString($_REQUEST['cart_token'],"text");
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
							}
						}
						break;
			}
		}
	}
?>


