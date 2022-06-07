<?php
require_once "./AppConstant.php";
require_once "./statucCodes.php";

	class FileUploading{

// ###########################################################################
// # 			uploads the image and save it to the desired folder
// ###########################################################################
		public static function upload_PPDT_File($file=array(), $type=null){
			$target = null;
			if(isset($file) && (!empty($file)) && ($type != null)){
				// self::debug(AppConstant::PPDT.$file['name']);
				switch($type){
					case 'PPDT':
						$target = AppConstant::PPDT_PATH.basename($file['name']);	
					break;
					case 'SCTU':
						$target = AppConstant::SCT_U_PATH.basename($file['name']);
					break;
					case 'SCTE':
						$target = AppConstant::SCT_E_PATH.basename($file['name']);
					break;
				} // --- end switch
				
				// checking if file is already exists in the folder
				if(!file_exists($target)){
					if(move_uploaded_file($file['tmp_name'], $target)){
						echo "
						<div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong>Success</strong>
							&nbsp;&nbsp;&nbsp;
							File  : <span style='color : green; font-weight: bold;	font-size: 12px;'>".$file['name']."</span> has been uploaded successfully.
						</div>";
					} else{
						echo "
						<div class='alert alert-error'>
							<a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong>Failed</strong>
							&nbsp;&nbsp;&nbsp;
							File : <span style='color : red; font-weight: bold;	font-size: 12px;'>".$file['name']."</span> upload failed.
						</div>";
					}
				} else{
					echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert'>&times;</a>
							<strong>Stop!</strong>
							&nbsp;&nbsp;&nbsp;
							File : <span style='color : red; font-weight: bold;	font-size: 12px;'>".$file['name']."</span> already exists.
						</div>";
				}// --- end if/else cond
			} // --- end if cond
			return;
		} // --- end func
// #####################################################
// #	Debugging 
// #		function listed below
// ####################################################
		public static function debug($input){
			echo "<pre>";
			echo print_r($input);
			echo "</pre>";
			die();
		} // --- end func
	} // --- end class
// $upload = new FileUploading(); // --- object of the class
// ###########################################################################
// # 			displaying upload image function
// ###########################################################################
if (isset($_SERVER['REQUEST_METHOD']) && (isset($_FILES['PPDT']) )) {

	$pass = $_FILES['PPDT'];
	$type = "PPDT";
	fileUploading::upload_PPDT_File($pass, $type);
}
if (isset($_SERVER['REQUEST_METHOD']) && (isset($_FILES['SCTU']) )) {

	$pass = $_FILES['SCTU'];
	$type = "SCTU";
	fileUploading::upload_PPDT_File($pass, $type);
}
if (isset($_SERVER['REQUEST_METHOD']) && (isset($_FILES['SCTE']) )) {

	$pass = $_FILES['SCTE'];
	$type = "SCTE";
	fileUploading::upload_PPDT_File($pass, $type);
}
?>