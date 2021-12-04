<?php require_once('Connections\conn.php') ?>
<?php
	if(!function_exists("toImage")){
		function toImage($data,$type){
		
			$img = imagecreatefromstring($data);
		
			if(($img!=FALSE) || ($type!=FALSE)) {
				header('Content-Type: ' . $type);
				if($type == "image/pjpeg" || $type == "image/jpeg"){
					imagejpeg($img);
				}elseif($type == "image/x-png" || $type == "image/png"){
					imagepng($img);
				}elseif($type == "image/gif"){
					imagegif($new_img);
				}
				imagedestroy($img);
			}
		}
	}
	
	if(trim($_SERVER['QUERY_STRING'])=='')
		exit;
	
	mysql_select_db($database_conn);
	
	
	if($_REQUEST['source']=='loc' && isset($_REQUEST['id']) && isset($_REQUEST['index'])){
		$query = "SELECT foto1,foto2,foto3 FROM tbl_produk_image WHERE token='".$_REQUEST['id']."'";
		$result = mysql_query($query,$conn);
		$row = mysql_fetch_array($result,MYSQL_NUM);		
		$dirPath = __DIR__.'\\upload_images\\';
		
		
		do{
			$filename = $row[$_REQUEST['index']];
			$names = explode(".",$filename);
			$name = $names[0];
			$ext = $names[1];
								
			$filePath = $dirPath.$filename;
			$data = file_get_contents($filePath);
			
			$type = ($ext=="pjpg" ? "image/pjpeg" : 
				($ext=="xpng" ? "image/x-png" : 
					($ext=="gif" ? "image/gif" :  
						($ext=="png" ? "image/png" : "image/jpeg"))));
			
			toImage($data,$type);
			break;
		}while($row = mysql_fetch_row($result,MYSQL_NUM));				
	}
	elseif($_REQUEST['source']=='bin'){
		$query = "SELECT foto1,foto1_ext,foto2,foto2_ext,foto3,foto3_ext FROM tbl_produk_image_binary ";
		$query.= "WHERE token='".$_REQUEST['id']."'";
		
		$result = mysql_query($query,$conn);
		$row = mysql_fetch_assoc($result);
		$dirPath = __DIR__.'\\upload_images\\';
		
		do{			
			$index = $_REQUEST['index']+1;
			$bin = $row['foto'.$index];
			$type = $row['foto'.$index."_ext"];			
						
			toImage($bin,$type);
			
		}while($row = mysql_fetch_assoc($result));
		
	}
?>