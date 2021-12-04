<?php require_once('Connections/conn.php');?>
<?php	
	if(!function_exists('execQuery')){
		function execQuery($query,$db,$cn){
			mysql_select_db($db,$cn);
			return mysql_query($query,$cn);
		}
	}
	
	if(!function_exists('uploadFoto')){
		function uploadFoto($id,$foto){		
			$index = trim(str_replace('produk_foto','',$foto));
			$dirPath= __DIR__.'\\upload_images\\';
			$file_name= basename($_FILES[$foto]['name']);
			$file_size = $_FILES[$foto]['size'];
			$file_type = $_FILES[$foto]['type'];
			$file_temp = $_FILES[$foto]['tmp_name'];
				
			$arrExt = explode('.', $_FILES[$foto]['name']);
			$file_ext = $arrExt[count($arrExt)-1];
					
			$filename = $id."_".$index.".".$file_ext;
			$tempFilePath = $dirPath . $filename;
								
			if(file_exists($tempFilePath))
				unlink($tempFilePath);
						
			if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
				$new_img = imagecreatefromjpeg($file_temp);
				imagejpeg($new_img, $tempFilePath);
			}
			elseif($file_type == "image/x-png" || $file_type == "image/png"){
				$new_img = imagecreatefrompng($file_temp);
				imagepng($new_img, $tempFilePath);
			}
			elseif($file_type == "image/gif"){
				$new_img = imagecreatefromgif($file_temp);
				imagegif($new_img, $tempFilePath);
			}
					
			imagedestroy($new_img);
					
			$fp = fopen($tempFilePath, 'r') or die('File Gambar tidak dapat dibuka');
						$data=fread($fp,filesize($tempFilePath));	
			fclose($fp);
					
			return array('filename'=>$filename, 'image' => array($data,$file_type));
		}
	}
	if(!function_exists('removeFoto')){
		function removeFoto($id){
			$dirPath = __DIR__.'\\upload_images\\';
			$filename = $dirPath . $id;
			if(file_exists($filename))
				unlink($filename);
		}
	}
	if(isset($_SERVER['QUERY_STRING'])){
		if(isset($_REQUEST['tabel'])){
			switch($_REQUEST['tabel']){
					case "kategori":
						if(!isset($_REQUEST['kategori_id']) || $_REQUEST['kategori_id']==''){
							$_REQUEST['kategori_id']=uniqid();
							$query = "INSERT INTO tbl_kategori(token,nama) VALUES ";
							$query.= "(".GetSQLValueString($_REQUEST['kategori_id'],"text").",";
							$query.= GetSQLValueString($_REQUEST['kategori_nama'],"text").")";
						}							
						else{
							if($_REQUEST['for']=='add'){
								$query = "UPDATE tbl_kategori SET ";
								$query.= "	nama=".GetSQLValueString($_REQUEST['kategori_nama'],"text")." ";
								$query.= "WHERE token=".GetSQLValueString($_REQUEST['kategori_id'],"text");
							}					elseif($_REQUEST['for']=='rem'){
								$query = "DELETE FROM tbl_kategori ";
								$query.= "WHERE token=".GetSQLValueString($_REQUEST['kategori_id'],"text");
							}
						}
						
						if(execQuery($query,$database_conn,$conn)) die(var_dump($query));
						break;
						
					case "produk":
						$id=uniqid();
						$foto1=array('filename' => "null", 'image' => array("null","null"));
						$foto2=array('filename' => "null", 'image' => array("null","null"));
						$foto3=array('filename' => "null", 'image' => array("null","null"));
						
						if(!isset($_REQUEST['produk_id']) || $_REQUEST['produk_id']==''){
							$_REQUEST['produk_id']=$id;
							$query = "INSERT INTO tbl_produk(token,nama,deskripsi,harga,harga_spesial,kategori_token) VALUES ";
							$query.= "(".GetSQLValueString($_REQUEST['produk_id'],"text").",";
							$query.= GetSQLValueString($_REQUEST['produk_nama'],"text").",";
							$query.= GetSQLValueString($_REQUEST['produk_deskripsi'],"text").",";
							$query.= GetSQLValueString($_REQUEST['produk_harga'],"long").",";
							$query.= GetSQLValueString($_REQUEST['produk_harga_spesial'],"long").",";
							$query.= GetSQLValueString($_REQUEST['produk_kategori'],"text").")";						
							
							if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
													
							if($_FILES['produk_foto1']['error']==0)
								$foto1=uploadFoto($id,'produk_foto1');
											
							if($_FILES['produk_foto2']['error']==0)
								$foto2=uploadFoto($id,'produk_foto2');
													
							if($_FILES['produk_foto3']['error']==0)
								$foto3=uploadFoto($id,'produk_foto3');
														
							$query = "INSERT INTO tbl_produk_image(token,foto1,foto2,foto3) VALUES ";
							$query.= "(".GetSQLValueString($_REQUEST['produk_id'],"text").", ";
							$query.= GetSQLValueString($foto1['filename'],"text").", ";
							$query.= GetSQLValueString($foto2['filename'],"text").",";
							$query.= GetSQLValueString($foto3['filename'],"text").")";						
							if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
													
							$query = "INSERT INTO tbl_produk_image_binary(token,foto1,foto1_ext,foto2,foto2_ext,foto3,foto3_ext) VALUES ";
							$query.= "(".GetSQLValueString($_REQUEST['produk_id'],"text").",";
							$query.= GetSQLValueString($foto1['image'][0],"text").",";
							$query.= GetSQLValueString($foto1['image'][1],"text").",";
							$query.= GetSQLValueString($foto2['image'][0],"text").",";
							$query.= GetSQLValueString($foto2['image'][1],"text").",";
							$query.= GetSQLValueString($foto3['image'][0],"text").",";
							$query.= GetSQLValueString($foto3['image'][1],"text").")";						
							if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
						}
						else{
							$where = "WHERE token=".GetSQLValueString($_REQUEST['produk_id'],"text");
													
							if($_REQUEST['for']=='add'){
								$query = "UPDATE tbl_produk SET ";
								$query.= "	nama=".GetSQLValueString($_REQUEST['produk_nama'],"text").",";
								$query.= " 	deskripsi=".GetSQLValueString($_REQUEST['produk_deskripsi'],"text").", ";
								$query.= " 	harga=".GetSQLValueString($_REQUEST['produk_harga'],"long").", ";
								$query.= " 	harga_spesial=".GetSQLValueString($_REQUEST['produk_harga_spesial'],"long").", ";
								$query.= " 	kategori_token=".GetSQLValueString($_REQUEST['produk_kategori'],"text")." ";
								$query.= $where;							
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
														
								$query = "UPDATE tbl_produk_image SET ";
								$query2= "UPDATE tbl_produk_image_binary SET ";
															
								if($_FILES['produk_foto1']['error']==0){
									$foto1=uploadFoto($_REQUEST['produk_id'],'produk_foto1');
									$query.= "	foto1=".GetSQLValueString($foto1['filename'],"text").",";
									$query2.= "	foto1=".GetSQLValueString($foto1['image'][0],"text").",";
									$query2.= "	foto1_ext=".GetSQLValueString($foto1['image'][1],"text").",";
								}
														
								if($_FILES['produk_foto2']['error']==0){
									$foto2=uploadFoto($_REQUEST['produk_id'],'produk_foto2');
									$query.= "	foto2=".GetSQLValueString($foto2['filename'],"text").",";
									$query2.= "	foto2=".GetSQLValueString($foto2['image'][0],"text").",";
									$query2.= "	foto2_ext=".GetSQLValueString($foto2['image'][1],"text").",";
								}
														
								if($_FILES['produk_foto3']['error']==0){
									$foto3=uploadFoto($_REQUEST['produk_id'],'produk_foto3');
									$query.= "	foto3=".GetSQLValueString($foto3['filename'],"text")." ";
									$query2.= "	foto3=".GetSQLValueString($foto3['image'][0],"text").",";
									$query2.= "	foto3_ext=".GetSQLValueString($foto3['image'][1],"text")." ";
								}
							
								$query = substr($query,0,strlen($query)-1);
								$query.= $where;
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
									
								$query = substr($query2,0,strlen($query2)-1);
								$query.= $where;
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
							}	
							elseif($_REQUEST['for']=='rem'){
								$query = "DELETE FROM tbl_produk " . $where;
							
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
							
								$query = "SELECT foto1,foto2,foto3 FROM tbl_produk_image " . $where;
								$result = execQuery($query,$database_conn,$conn);
								$row = mysql_fetch_assoc($result);
							
								do{
									foreach($row as $column => $value){
										var_dump($row[$column]);
										removeFoto($row[$column]);
									}
								}while($row = mysql_fetch_assoc($result));
							
								$query = "DELETE FROM tbl_produk_image " . $where;
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
															
								$query = "DELETE FROM tbl_produk_image_binary ".$where;
								
								if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));
							}
						}

						break;
						
					case "user":
						if(!isset($_REQUEST['user_id']) || $_REQUEST['user_id']==''){
							$_REQUEST['user_id']=uniqid();
							$id = GetSQLValueString($_REQUEST['user_id'],"text");
							$user = GetSQLValueString($_REQUEST['user_nama'],"text");
							$pass = GetSQLValueString($_REQUEST['user_password'],"text");
							$md5_pass = md5($user.$id.$pass);
													
							$query = "INSERT INTO tbl_user(token,username,password) VALUES ";
							$query.= "(".GetSQLValueString($_REQUEST['user_id'],"text").",";
							$query.= GetSQLValueString($_REQUEST['user_nama'],"text").",";
							$query.= GetSQLValueString($md5_pass,"text").")";
						}							
						else{
							if($_REQUEST['for']=='add'){
								$id = GetSQLValueString($_REQUEST['user_id'],"text");
								$user = GetSQLValueString($_REQUEST['user_nama'],"text");
								$pass = GetSQLValueString($_REQUEST['user_password'],"text");
								$md5_pass = md5($user.$id.$pass);
														
								if(($_POST['user_nama']!='') && ($_POST['user_password']!='')){
									$query = "UPDATE tbl_user SET ";
									$query.= "	username=".GetSQLValueString($_REQUEST['user_nama'],"text").", ";
									$query.= "	password=".GetSQLValueString($md5_pass,"text")." ";
									$query.= "WHERE token=".GetSQLValueString($_REQUEST['user_id'],"text");
								}
								else{
									$query = "UPDATE tbl_user SET ";
									$query.= "	username=".GetSQLValueString($_REQUEST['user_nama'],"text")." ";
									$query.= "WHERE token=".GetSQLValueString($_REQUEST['user_id'],"text");
								}
							}
							elseif($_REQUEST['for']=='rem'){
								$query = "DELETE FROM tbl_user ";
								$query.= "WHERE token=".GetSQLValueString($_REQUEST['user_id'],"text");
							}
						}
							
						if(!execQuery($query,$database_conn,$conn)) die(var_dump($query));

						break;
		}
	}
}
?>
