<?php
	include("../config.php");
	require("../js/resize_photo.php");

	// file name
	$filename = basename($_FILES["file"]["name"]);

	$id_persona = $_POST['ID_PERSONA'];

	// file extension
	$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
		
	$filename = $id_persona.".".$file_extension;

	// Location
	$location = "../imagenes/fotos_personas/".$filename;

	

	// Valid image extensions
	$image_ext = array("jpg","png","jpeg","gif");

	$response = 0;
	if(in_array($file_extension,$image_ext)){
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)){

			$img = resize_image($location, 600, 600);
			imagejpeg($img, $location);

			$sql = "UPDATE PERSONA SET IMAGEN = '../imagenes/fotos_personas/".$filename."' WHERE ID_PERSONA=".$id_persona;
			if ($con->query($sql) === TRUE){			
				$response = "../imagenes/fotos_personas/".$filename;
			}
		}
		else{
			$response = 1;
		}
	}
	echo $response;	

?>


