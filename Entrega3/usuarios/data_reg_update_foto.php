<?php
	include("../config.php");
	require("../js/resize_photo.php");

	// file name
	$filename = basename($_FILES["file"]["name"]);

	$id = $_POST['ID'];

	// file extension
	$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
		
	$filename = $id.".".$file_extension;

	// Location
	$location = "../imagenes/fotos_usuarios/".$filename;

	

	// Valid image extensions
	$image_ext = array("jpg","png","jpeg","gif");

	$response = 0;
	if(in_array($file_extension,$image_ext)){
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)){

			$img = resize_image($location, 600, 600);
			imagejpeg($img, $location);

			$sql = "UPDATE users SET IMAGEN = '../imagenes/fotos_usuarios/".$filename."' WHERE id=".$id;
			if ($con->query($sql) === TRUE){			
				$response = "../imagenes/fotos_usuarios/".$filename;

				if ($_SESSION["id"]=== $id){
					session_start();
					$_SESSION["IMAGEN"] = "../imagenes/fotos_usuarios/".$filename;
				}
			}
		}
		else{
			$response = 1;
		}
	}
	echo $response;	

?>


