<?php

require_once "./Main.php";
	class logout{

		public static function getLogout($access = null){
			if(isset($_SESSION['access_dnn']) && ($access != null) && ($access == 1)){
				// Main::dd("i am validated in logout");
				unset($_SESSION['access_dnn']); // --- session destroyed here
				echo "<div class='alert alert-success'><strong>Seccess</strong> Logout Successfully<a href='#' data-toggle='tooltip' title='Click to Login Panel' onclick='getMenues()' data-dismiss='alert' class='close'><i class='glyphicon glyphicon-remove'></i></a></div>
						<script> $(document).ready( function (){ $('[data-toggle=\"tooltip\"]').tooltip(); }); </script>";
			}
		} // --- end func
	} // --- end class

	$logout = new logout();
	if(isset($_POST['dnnLogout']) && ($_POST['dnnLogout'] != "")){
		$access = htmlentities($_POST['dnnLogout']);
		$logout->getLogout($access);	
	}
	
?>