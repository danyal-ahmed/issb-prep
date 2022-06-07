<?php 
session_start();
require_once("./php/AppConstant.php");

$releaseLock = 0;
?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<title>ISSB PREP</title>
  
   
	 <link rel="stylesheet" type="text/css" href="./css/theme/bootstrap.min.css" />
   <link rel="stylesheet" type="text/css" href="./css/jquery-ui.min.css" />
   <link rel="stylesheet" type="text/css" href="./css/dropzone.min.css" />
   <link rel="stylesheet" type="text/css" href="./css/custom.css" />  
	
  <script type="text/javascript" src='./js/jquery.min.js'></script>
  
  <!-- adding choosen plugin files here below -->
  <link rel="stylesheet" type="text/css" href="./chosen_v1.7.0/chosen.min.css" />
  <script type="text/javascript" src='./chosen_v1.7.0/chosen.jquery.min.js'></script>
  <script type="text/javascript" src='./chosen_v1.7.0/docsupport/init.js'></script>
	<script type="text/javascript" src='./js/bootstrap.min.js'></script>
  <script type="text/javascript" src='./css/plugin/fancyText/js/jquery.burn.min.js'></script>
  <!-- DNN text typing here below -->
    <script type='text/javascript' src='./css/plugin/dnn_Type/src/typeit.js'></script>
   <!-- Jquery-ui ( js ) file included here -->
   <script type="text/javascript" src='./js/jquery-ui.min.js'></script>
   
   <!-- DNN web developers -->
  <script type="text/javascript" src='./js/custom.js'></script>

</head>
<body>
	<div class='container'> <!-- 01 -->
		<div class='row'>  <!-- 02 -->
			<div class='col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-xs-offset-0 col-sm-offset-0'> <!-- 03 -->
          <div class='container'> <!-- container (dnn 01) -->
            <div class='row'> <!-- row (dnn 01) -->
				<div class="panel panel-warning centerDiv"><!--  04 -->
   					 <div class="panel-heading"><!-- 05 -->
   					 	<?php 
   					 		$access = (isset( $_SESSION['access_dnn']) ?  $_SESSION['access_dnn'] : "");
   					 		if(isset($access) && ($access != "") && (base64_decode($access) == AppConstant::APP_ACCESS)){
   					 			echo AppConstant::WELLCOME;
   					 			$releaseLock = 1;
   					 		} else{
   					 			echo sprintf("%s ", AppConstant::PRIMARY);
   					 		}// --- end if/else cond
   					 	?>
   					 </div> <!-- 05 -->
    					<div class="panel-body"><!-- 06 -->
    						<!-- Image of ISSB logo is down below -->
    						<img src='./img/ISSB.jpg' class='img-circle center-block' height='130' width='130' />
    						<br /><br /><br />
    						<div class='clearfix'></div>
                
    						<div class='col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1' id='mainDiv' > <!-- 0.1 -->
    						
                  <?php 
    								if($releaseLock == 1){
                        echo "<script type='text/javascript'>
                        getMenues();
                          
                        </script>";
    									
    								} else if($releaseLock == 0){
    									echo "
    										<div class='form-group'>
    											<label>Password</label>
    											<input type='password' name='appAccess' class='form-control' id='passAccess' maxlength='15' />
    										</div>
    										<div class='form-group'>
    										   <input type='button' onclick='passwordGet()' class='btn btn-primary' id='subAccess' value='Get Access' />
    										</div>";
    								} // --- end if cond
    							?>
    						</div> <!-- 0.1 -->
              </div> <!-- row (dnn 02) -->
            </div> <!-- container (dnn 02) -->
    					</div><!-- 06 -->
  				</div><!-- 04 -->
        
			</div> <!-- 03 -->
		</div> <!-- 02 -->
    <!-- ########### starting footer from here ######## -->
    <footer class='footer'>
      <div class='container'>
        <div class='row'>
         <div class='panel panel-warning'>
          <div class='panel-body'>
          <div class='col-md-4 col-sm-4 col-xs-4'>&copy; <strong>All Rights Reserved!</strong></div>
          <div class='col-md-4 col-sm-4 col-xs-4' style='margin-left:auto; margin-right:auto;'>this is in center</div>
          <div class='col-md-4 col-sm-4 col-xs-4'><a href='#'><strong>DNN Developers</strong></div>
        </div>
        </div>
        </div>
      </div>
    </footer>
    
	</div> <!-- 01 -->
<script type="text/javascript" src='./dropzone.min.js'></script>

</body>
</html>