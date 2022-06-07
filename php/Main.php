<?php
	session_start();
	require_once("../php/AppConstant.php");
	class Main{
// ###########################################################################
// #		below function will evaluate the password and made
// #   	  session as login user, also this encripts the session 
// ############################################################################		
		public static function evaluatePassword($pass = null){
			if(($pass != null) && ($pass != "")){
				if($pass == AppConstant::APP_ACCESS){
					$_SESSION['access_dnn'] = base64_encode($pass); 
					self::makeMenues(1);
				}
			} // --- end if cond
			
		} // --- end fund
// ###########################################################################
// #			below function is actually displaing
// #		WAT at random basis when the function called
// ############################################################################
		public static function displayWAT(){
			$file = AppConstant::WAT;
			$wats = array();
			$content = null;
			$handler = null;
			$word = null;
			if(file_exists($file)){
				$handler = fopen($file, "r") or die(0);
				if(isset($handler) && ($handler != null) && ($handler != 0)){
					$size = filesize($file);
					$content = fread($handler, $size);
					$wats = explode(",", $content);
					$word = $wats[array_rand($wats)];
					if(isset($word) && ($word == "")){
						$word = $wats[array_rand($wats)];
					}
					echo "<span id='WAT-font' class='burning'	>".$word."<span>
					
					";
					
				}// --- end if cond
			} else{
				self::makeWatFile();
			}
						
		} // --- end func 
// ###########################################################################
// #		when there is no file created in the directory 					  #
// #		this below function will create file for use 					  #
// ###########################################################################
		public static function makeWatFile(){
			$addr = AppConstant::WAT;
			$file = null;
			$fileSize = null;
			$content = null;
			$words = array();
			
				$wats = "
				atom,country,army,step,country,love,duty,girl,eat,decide,beat,fight,lie,give,
						enjoy,careful,success,trust,solve,story,break,fear,defeat,enemy,devil,evil,time,abreast,
						steal,work,decide,beat,fight,lie,give,trust,garden,faith,help,cinema,money,peace,fine,
						daley,money,peace,fine,character,travel,money,ghost,monster,respect,duty,life,poor,use,climb,
						problem,attempt,happy,books,rest,short,design,co-operative,discipline,pain,plain,plan,think,hobby,
						obtain,idea,religion,morality,innovation,beat,lead,afraid,machine,win,innovation,punctuality,continue,
						honesty,protect,task,slip,drop,snake,award,achieve,assist,action,agreed,avoid,award,alone,
						ambition,appeal,air,arrived,bad,blood,beautiful,cut,copy,attack,home,able,excuse,luck,knife,
						encourage,danger,officer,sad,soldier,can-not,drink,begin,holiday,women,date,save,Fellow,Dictatorship,
						Save,Sick,War,Alone,Father,System,Make,Work,Difficulty,Health,Impossible,Lonely,Affection,Sympathy,
						Company,Courage,Meet,Secure,Responsibility,Love,Sports,Responsile,Tried,Boat,Failure,Science,
						Peace,Sky,Goal,Busy,Mother,Save,Urge,False,Knowledge,Sleep,Unfair,Sister,Can not,Project,Regular,
						Advantage,Climb,Now,Tie,Flow,Light,Pressure,Dig,Sink,Co-operative,Change,Coward,Decide,Rest,Avoid,
						Shine,Rummer,Humble,Defender,Time,Easy,Take,Natural,Talk,Revenge,Serious,Shine,Democracy,Award,
						Withdraw,Defeat,Snake,Music,Army,Use,Help,Interest,Fast,Train,Reaction,Health,Reaction,Fortune,
						Merry,Find,Differ,Light,Victory,Trail,Marching,Lose,Meet,Simple,Rent,Jump,Secret,Hate,Pretest,
						Fond,Sacrifice,Disagree,Misfortune,Choose,Genuine,Pick,Efficiency,Childhood,Death,Brace,War,Foreign,
						Admire,Advice,Coward,Shoot,Unable,Puzzle,Criticism,Keen,Organization,Progress,Confuse,Begin,Adopt,
						Loyal,Pleasure,Stop,Struggle,Gallant,Insist,Life,Football,Punish,Worry,Provide,Society,Need,Job,
						Color,Bright,King,Sex,Bold,Leader,Sincere,Will,Education,Risk,Run,Wife,Note,Keep,Follow,
						Fever,Hope,Overcome,Reform,Fair,Haste,Strange,Blunt,Annoy,Wisdom,Persuade,Zeal,Compel,Service,
						Injustice,Possible,Future,Old,Weak,Strength,Suicide,Win,";
						$file = fopen($addr, "w");
						fwrite($file, $wats);
						fclose($file);
						echo "
							<h2 class='customStyle'>File is being created...</h2>
							<div class='form-group'>
								<button class='btn btn-success' onclick='goToWAT()'
								 title='Click to start test' data-toggle='tooltip' type='button'>
								 Proceed to test</button>
							</div>
							<script>
						  $(document).ready(function (){
						    $('[data-toggle=\"tooltip\"]').tooltip();
						  });
						</script>
							";
		} // --- end func
// ###########################################################################
// #		below function will show menues as 
// #	application will have the functionality to do
// ############################################################################
		public static function makeMenues($access=null){
			if(isset($access) && ($access != null) && ($access == 1)){
				echo "
				<div class='row'>
					<div class='col-md-3 col-sm-3 col-xs-3'>
						<div class='btn-group' id='menu_button' >

							<button name='wat' id='wat_01' class='btn dropdown-toggle'
									data-toggle='dropdown' >Word Assoc Test
							 <span class='caret'></span></button>
								<ul class='dropdown-menu' role='menu'>
									<li><a href='#' onclick='show_WAT_MSGS()'> Start Test </a></li>
									<li><a href='#' onclick='goToAddWAT()'> Add Word </a></li>
									<li><a href='#' onclick='goToDeleteWAT()'> Remove Word </a></li>
								</ul>
						</div> 
					</div>
					
					<div class='col-md-3 col-sm-3 col-xs-3'>
						<div class='btn-group' id='menu_button_01'>
							<button name='wat' id='wat_02' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
								Pict Percep Test <span class='caret'></span></button>
								<ul class='dropdown-menu' role='menu'>
									<li><a href='#' id='wat' onclick='goToPPDT()'> Start test </a></li>
									<li><a href='#' id='wat' onclick='uploadPPDT()'> Upload picture </a></li>
									<li><a href='#' id='wat' onclick='removePPDT()'> Remove picture </a></li>
								</ul>
						</div>
					</div>
					
					<div class='col-md-3 col-sm-3 col-xs-3'>
						<div class='btn-group' id='menu_button_02'>
							<button name='wat' id='wat_03' class='btn btn-warning dropdown-toggle' data-toggle='dropdown'>
							Sentences urdu <span class='caret'></span></button>
								<ul class='dropdown-menu' role='menu'>
									<li><a href='#' id='wat' onclick='goToSCTU()'> Start test urdu</a></li>
									<li><a href='#' id='wat' onclick='upload_SCTU_File()'> Upload sentence sheet </a></li>
									<li><a href='#' id='wat' onclick='removeSCT_URDU()'> Remove sentence sheet </a></li>
								</ul>
						</div>
					</div>
					
					<div class='col-md-3 col-sm-3 col-xs-3'>
						<div class='btn-group' id='menu_button_03'>
							<button name='wat' id='wat_04' class='btn btn-success dropdown-toggle' data-toggle='dropdown'>
							Sentences english <span class='caret'></span></button>
								<ul class='dropdown-menu' role='menu'>
									<li><a href='#' id='wat' onclick='goToSCTE()'> Start test english</a></li>
									<li><a href='#' id='wat' onclick='upload_SCTE_File()'> Upload sentence sheet </a></li>
									<li><a href='#' id='wat' onclick='removeSCT_ENGLISH()'> Remove sentence sheet </a></li>
								</ul>
						</div>
					</div>
				</div>
				";
			} // --- end if cond
		} // --- end func
// ###########################################################################
// #	this below function will display a form to add word in WAT
// ############################################################################
		public static function addWord(){
			echo "
			<div class='form-group'>
			<label>Insert Word</label>
				<input type='text' class='form-control' id='addWAT' name='addWAT' data-toggle='tooltip' title='Add word in your word dictionary' />
			</div>
			<div class='form-group'>
				<button type='button' class='btn btn-success' data-toggle='tooltip'
				 title='Add word to your words dictionary' onclick='addWAT()' >
				 <i class='glyphicon glyphicon-floppy-saved'></i> Add Word </button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type='button' class='btn btn-danger' onclick='getMenues()' 
				 data-toggle='tooltip' title='Back to main menu'>
					<i class='glyphicon glyphicon-arrow-left'></i> Back </button>
				
			</div>
			<script>
				$().ready(function (){
					$('[data-toggle=\"tooltip\"]').tooltip();
				});
			</script>
			";
		} // --- end func
// ###########################################################################
// #    		below function will display form
// #	 to get word using this form for further remove
// ############################################################################
		public static function removeWord(){
			$file = AppConstant::WAT;
			$wats = array();
			$content = null;
			$handler = null;
			$word = null;
			if(file_exists($file)){
				$handler = fopen($file, "r") or die(0);
				if(isset($handler) && ($handler != null) && ($handler != 0)){
					$size = filesize($file);
					// self::dd($size);
					$content = fread($handler, $size);
					$wats = explode(",", $content);
				}// --- end if cond
			} 

			echo "
			<div class='form-group' >
				<select class='chosen select2' id='deleteWAT'
				 data-toggle='tooltip' title='Select word to delete' >
					<option value='0'> Select a word </option>";
					foreach ($wats as $key) {
						echo "<option value='".$key."'> ".$key." </option>";
					} // --- end foreach
			echo "		
				</select>
			</div>
			<div class='form-group'>
				<button type='button' class='btn btn-info' data-toggle='tooltip'
				 title='Click to delete selected word' onclick='delWAT()' >
				 <i class='glyphicon glyphicon-ok'></i> Delete</button>
				&nbsp;&nbsp;&nbsp;
				<button type='button' class='btn btn-danger' data-toggle='tooltip' 
				title='Go to main menu'mvalue='Go Back' onclick='getMenues()' >
				<i class='glyphicon glyphicon-arrow-left'></i> Back</button>
			</div>
			<script type='text/javascript'>
    			$(document).ready( function (){
      				$('.select2').chosen();
      				$('[data-toggle=\"tooltip\"]').tooltip();
    			});
  			</script>
			";
		} // --- end func
// ###########################################################################
// #    		below function will add word to the file
// #	the file have all the WAT's words which were use in test
// ############################################################################
		public static function addWAT($word = null){
			$file = AppConstant::WAT;
			$fileCont  = null;
			$fileCont =  fopen($file, "a+") or die(1);
			if(($fileCont != null) && ($fileCont != 0) && ($word != null)){
				fwrite($fileCont, $word.",");
				fclose($fileCont);
				echo "<div class='alert alert-success'>
				<a class='close' data-dismiss='alert' data-toggle='tooltip' title='Close' onclick='getMenues()'>&times;</a>
					<strong>Success</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Word has been added successfully
				</div>
				<script>
				  $(document).ready(function (){
				    $('[data-toggle=\"tooltip\"]').tooltip();
				  });
				</script>
				";
			} // --- end if cond
		} // --- end func
// ###########################################################################
// #		below function will remove any word from
// #					the WAT file 
// ############################################################################
		public static function deleteWAT($word = null){
			$file = AppConstant::WAT;
			$fileCont = null;
			$getWords = null;
			$changed = null;
			if(isset($word) && ($word != "") && ($word != null)){
				$content = fopen($file, "r") or die(1);
				if(isset($content) && ($content != 1)){
					$filesize = filesize($file);
					$getWords = fread($content, $filesize);
					if(isset($getWords) && ($getWords != null)){
						$removal = trim($word.",");
						$changed = str_replace($removal, "", $getWords);
						fclose($content);
						self::makeWholeFile($changed); // --- all the replaced content is tranferd
					} // --- end if cond
				} // --- end if cond
			} // --- end if cond
		} // --- end func
// ###########################################################################
// #			below function will take a whole file as
// #	its input and write a new file and delete the previous one
// ############################################################################
		public static function makeWholeFile($file=null){
			$file_name = AppConstant::WAT;
			if(isset($file) && ($file != null)){
				if(unlink($file_name)){
					$myFile = fopen($file_name, "w");
							fwrite($myFile, $file);
							if(fclose($myFile)){
								echo "<div class='alert alert-success'>
									<a class='close' data-dismiss='alert' data-toggle='tooltip' title='Close' onclick='getMenues()'>&times;</a>
										<strong>Success</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Word has been added successfully
									</div>
									<script>
									  $(document).ready(function (){
									    $('[data-toggle=\"tooltip\"]').tooltip();
									  });
								    </script>
									";
							} // --- end func

				} // --- end if cond
			} // --- end if cond
		} // --- end func

// ###########################################################################
// # 			debugging function is here below
// ###########################################################################
		public static function dd($input){
			echo "<pre>";
			print_r($input);
			echo "</pre>";
			die();
		} // --- end func
		public static function d($input){
			echo "<pre>";
			print_r($input);
			echo "</pre>";
		} // --- end func
// ###########################################################################
// #		below function display instruction msg before picture show
// ###########################################################################
		public static function displayPPMsg($access=null){
			if(isset($access) && ($access != null) && ($access == 1)){
				echo "
					<div class='alert alert-warning'>
						<a href='#' class='close' data-toggle='tooltip' title='Close' data-dismiss='alert' onclick='getMenues()'>&times;</a>".
						"<h1>Picture Perception Description Test</h1>".
						"<h2><i class='glyphicon glyphicon-alert'> Instructions </i></h2>
						<div class='clearfix'></div>
						<h5 id='dnn_typed' class='col-md-5 col-sm-5 col-xs-5'></h5>
						<script>
						var typed = new TypeIt('#dnn_typed', {
							speed: 50,
							html: true,
							lifeLike: true,
				            autoStart:false,
						})
						.type('<li>All images will be shown only for 30 seconds.</li>'+
				              '<li>You will get ( 3 min & 25 sec\'s ) to write story.</li>'+
				              '<li>You will write 5 stories in english.</li>')
						.pause(500)
						.type('<br/>')
						.type('<br/>')

						.type('Click <strong>Start Test </strong>Button to continue')
						.options({speed:700})
						.pause(500)
						.type(' .....');
							
						</script>
						<div class='clearfix'></div>
						<br/>
						<div class='form-group'>
							<button type='button' class='btn btn-info' data-toggle='tooltip' 
							title='Click to start test'  onclick='procedPPDT()' >
							<i class='glyphicon glyphicon-edit'></i> Start Test</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type='button' class='btn btn-danger'  data-toggle='tooltip' title='Click to main menu' onclick='getMenues()' >
							<i class='glyphicon glyphicon-arrow-left'> Back </i> </button>
						</div>
					</div>
					<script>
						  $(document).ready(function (){
						    $('[data-toggle=\"tooltip\"]').tooltip();
						  });
					</script>
					";
			} // --- end if cond
		} // --- end func
// ###########################################################################
// # 	   below function is displaying random images
// ###########################################################################
		public static function displayImages($access=null){
			$dir = null; $i=0; $file_names=array();
			if(isset($access) && ($access != null) && ($access == 1)){
				// self::dd($_SERVER['SERVER_NAME'].AppConstant::PPDT);
				$dir = dir(AppConstant::PPDT) or die(1);
				if(isset($dir) && ($dir != null) ){
					while(($file = $dir->read()) !== false){
						if( ($file != ".") && ($file != "..") ){
							$file_names[$i] = $file;
							$i++;
						} // --- end if cond
					} // --- end while
					echo "<h1 class='burning' id='WAT-font'> Observe story </h1>";
					echo "
							<span class='pull-right'>
								<span id='timer' class='timerStyle'></span>
							</span>
						<img src='".str_replace("..", "./", AppConstant::PPDT).$file_names[array_rand($file_names)]."' width='350' height='350' class='img-round' />
							  <br /><br />
							  <div class='form-group'>
							  	<button type='button' class='btn btn-danger' data-toggle='tooltip' 
							  	title='Go to main menu' onclick='getMenues()' id='back'>
							  	<i class='glyphicon glyphicon-arrow-left'></i> Back</button>
							  </div>
							  <script>
							  	$(document).ready(function(){
							  		$('[data-toggle=\"tooltip\"]').tooltip();
							  		$('#back').on('click', function(){
							  			console.log('%c30 sec timer her been terminated', 'background-color:red;');
							  			clearInterval(timeOut);
							  		});
							  	});
								    var timeLeft = 30;
									var myElement = document.getElementById('timer');
									var timeOut = setInterval(countDown, 1000);
									function countDown(){
										if(timeLeft == 0){
											clearInterval(timeOut);
										} else{
											if((myElement != null) && (myElement != undefined)){
												myElement.innerHTML = '00 : 00 : '+timeLeft ;
												timeLeft = timeLeft - 1;
											} else{
												console.log('%c30 sec timer her been terminated', 'background-color:red;');
												clearInterval(timeOut);
											}
											
										} // --- end if/else cond
									} // --- end func
							  </script>
							  "; 
				} // --- end if cond
			} // --- end if cond
		} // --- end func
// ###########################################################################
// # 		display message to write story
// ###########################################################################
		public static function startWriting($access=null){
			$number=3;
			if(isset($access) && ($access != null) && ($access == 1)){
				$_SESSION['story_number'] = $number;
				if(isset($_SESSION['story_number']) && ($_SESSION['story_number'] > 0) && ($_SESSION['story_number'] < 5)){
					$number = $_SESSION['story_number'];
					$number = $number +1;
					$_SESSION['story_number'] = $number;
				} else{
					$number = 1;
					$_SESSION['story_number'] = $number;
				}
				echo "
				<div class='panel panel-warning'> <!-- panel start div -->
					<div class='panel-heading'> <!-- panel heading -->
					<h3>".AppConstant::WHITE_TXT_START."Picture Perception Description Test <div id='ppdt_time' class='pull-right'></div>".AppConstant::WHITE_TXT_END."</h3>
					</div> <!-- panel heading end -->
				<div class='panel-body'> <!-- panel body start -->
					
						<div class='alert alert-warning'>
								<a href='#' class='close' data-dismiss='alert' data-toggle='tooltip' 
									  	title='Return to main menu' onclick='getMenues()'>&times;</a>
								<h1 >Start writting!</h1>
								<h4 class='pull-right'>Story Number : ".$number."</h4>
								<ul>
								<li><h3 > You have ( <span class='specialStyle'>3 minutes </span>) to complete story </h3></li>
								<li><h4>After <strong>3 minutes </strong>next story will appear automatically.</h4></li>
							 		<div class='clearfix'></div>
							 		<br /><br />
								  <div class='form-group'>
									  	<button type='button' class='btn btn-danger' data-toggle='tooltip' 
									  	title='Go to main menu' onclick='getMenues()' >
									  	<i class='glyphicon glyphicon-arrow-left'></i> Back</button>
								  </div>
						</div>
				</div> <!-- panel body end -->
				</div> <!-- panel start (end) -->
						<script type='text/javascript'>
						var the_timer_interval;
										function myTimer(the_timer){
											var timer = the_timer, minutes, seconds;
											if(the_timer_interval != null){
												clearInterval(the_timer_interval);
											}
											the_timer_interval =  setInterval(
												function(){
													minutes = parseInt(timer / 60, 10);
													seconds = parseInt(timer % 60, 10);

													 minutes = minutes < 10 ? '0' + minutes : minutes;
        											 seconds = seconds < 10 ? '0' + seconds : seconds;
        											 if(document.getElementById('ppdt_time') != null){
        											 	document.getElementById('ppdt_time').innerHTML = '<h4>'+ minutes + ':' + seconds + '</h4>';
        											 } else{
        											 	clearInterval(the_timer_interval);
        											 }
        											  

											        if (--timer <= 0) {
											        	clearInterval(the_timer_interval);
											            timer = the_timer;
											        }
												}, 1000);
										} // --- end func
										myTimer((3*60));
										</script>	";
			} // --- end if cond
		} // --- end func
// ###########################################################################
// # 		upload form for PPDT 
// ###########################################################################
		public static function updloadForm($access = null, $uploadType=null){
			if(isset($access) && ($access = "91221dnn") && ($uploadType != null)){
				
				$newForm = "
				<div class='container'> <!-- container 01 -->
					<div class='row'> <!-- row 01 -->
						<div class='col-md-8 col-sm-8 col-xs-8'> <!-- div 01 -->
							<form class='dropzone'  id='myId'></form>
						</div> <!-- div 01 -->
					</div> <!-- row 01 -->
					<br />
					<div class='clearfix'></div>
				</div> <!-- container 01 -->
						<div class='container'> <!-- container 02 -->
							<div class='row'> <!-- row 02 -->
								<div class='col-md-8 col-sm-8 col-xs-8' id='uploadMsg'></div>
								<div class='form-group'>
									<button class='btn btn-warning' title='Click to go back' data-toggle='tooltip' 
									type='button' onclick='getMenues()'> <i class='glyphicon glyphicon-arrow-left'> Back</i></button>
								</div>
									<script type='text/javascript'>
										$(document).ready(function(){
											$('form#myId').dropzone({ 
												url : './php/fileUploading.php',
												dictDefaultMessage : 'Drag File Here ( or ) Click to Select File',
												paramName : '".$uploadType."',
												maxFilesize : 2,
												maxFiles : 9,
												acceptedFiles : '.jpeg, .png, .jpg',
												
												init : function(){
													// on success by PHP
													this.on('success', function(file, respond){
														$('#uploadMsg').prepend(respond);
													});
													// on canceling all uploads
													this.on('removedFile', function(file){});
													// on error the application may respond 
													this.on('error', function(errorMessage){
														alert('Error : '+errorMessage.val());
													});									
												}, // --- end func ( init )
											}); // --- end form drag-nd drop 
											
										// begining tooltip here
									   $('[data-toggle=\"tooltip\"]').tooltip();
						 
										});
									</script>
								</div> <!-- row 02 -->
							</div> <!-- container 02 -->		
						
				";
				echo $newForm;
			} // --- end if cond
		} // --- end func
// ###########################################################################
// # 		show instruction message for Word-Assosiation-Test
// ###########################################################################
		public static function show_WAT_MSG($access=null){
			$MSG = null; // --- will contain message template

			if(isset($access) && ($access != null) && ($access == 'message_WAT_show')){
				$MSG = "
					<div class='panel panel-warning'> <!-- main panel div start -->
						<div class='panel-heading'><!-- main panel heading div -->
							<h3>".AppConstant::WHITE_TXT_START."Word Association Test".AppConstant::WHITE_TXT_END."</h3>
							<a href='#' class='close pull-right' data-dismiss='panel' data-toggle='tooltip'
								title='Back to main menu' onclick='getMenues()' >
								<i class='glyphicon glyphicon-remove'></i> </a>
						</div> <!-- main panel heading end -->
						<div class='panel-body'> <!-- main panel body div start -->
							<div class='alert alert-danger'> <!-- alert body start -->
								<h1><i class='glyphicon glyphicon-alert'></i>&nbsp;Instructions</h1>
								<hr />
								<div class='clearfix'></div>
								<br />
								<div id='show_WAT_MESSAGE'></div>
								<div class='clearfix'></div>
								<br />
								<div class='form-group'>
									<button type='button' class='btn btn-info' data-toggle='tooltip' 
									title='Click to start test'  onclick='goToWAT()' >
									<i class='glyphicon glyphicon-edit'></i> Start Test</button>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button type='button' class='btn btn-danger'  data-toggle='tooltip' title='Click to main menu' onclick='getMenues()' >
									<i class='glyphicon glyphicon-arrow-left'> Back </i> </button>		
								</div>
							</div> <!-- alert body end -->
						</div> <!-- main panel body div end -->
					</div> <!-- main panel div end -->
					<script>
						 // // checking if the WAT-information containing div is available
       //      if( (document.getElementById('show_WAT_MESSAGE') != undefined) && (document.getElementById('show_WAT_MESSAGE').length > 0) ){
       //      //clearInterval(the_timer_interval);    
            var WAT_MSG = new TypeIt('#show_WAT_MESSAGE', {
                speed: 50,
                html: true,
                lifeLike: true,
                autoStart:false,
            })
            .type('<li>You will have to write an appropriate sentence against each word.</li>')
            .pause(500)
            .type('<li>You will be given about 70 words.</li>')
            .pause(500)
            .type('<li>Maximum time duration between the words are 7 to 8 seconds.</li>')
            .pause(500)
            .type('<li>Words would be change along with the sound of BEEP.</li>')
            .pause(500)
            .type('<li>Make as much sentences as you can.</li>')
            .pause(500)
            .type('<li>Do not think too long.</li>')
            .pause(500)
            .type('<li>Pick the 1st idea that comes in your mind.</li>')
            .pause(500)
            .type('<br/>')
            .pause(500)
            .type('<br/>')
            .pause(500)
            .type('Hit <strong>Start Test</strong> button to continue.</li>')
            .options({speed : 700})
            .pause(500)
            .type('.....');
            // } // --- end if cond
					</script>
				";
			} // --- end if cond
			echo $MSG;
		} // --- end func
// ###########################################################################
// # 		List All Images from PPDT 
// ###########################################################################
		public static function list_All_PPDT($path=null, $access, $type = null){
			$dir = null;
			$i=0;
			if(isset($access) && ($access == AppConstant::PPDT_LIST_IMGS_CODE) && ($path != null)){
				if(is_dir($path)){
					$dir = opendir($path);
					// echo "
					// 	<div class='container'> <!-- container 01 -->
					// 		<div class='row'> <!-- row 01 -->
					// 			";
					
					while(($file = readdir($dir)) !== false){
						if(($file != '.') && ($file != '..')){
							if($i == 0){
								echo "<div class='col-md-10 col-sm-10 col-xs-10
								 col-md-offset-1 col-sm-offset-1 col-xs-offset-1'> <!-- div 01 -->";
								 echo "<div class='col-md-3 col-sm-3 col-xs-3'>
									<div class='alert alert-danger'>
										<a href='#' title='close' data-toggle='tooltip' class='close' data-dismiss='alert'>&times;</a>
										<img src='".substr($path.$file, 1, strlen($path.$file))."' class='img-thumbnail img-responsive' width='90' height='80'  alt='".$file."' />
										&nbsp;&nbsp;&nbsp;&nbsp;
										<a href='#' data-toggle='tooltip' title='Click to remove file permanently' onclick='removeImage(\"".strrev($type)."\", \"".$file."\")'>Remove</a>
									</div>
								</div>
								";
							} else{
								if($file != ""){
									echo "<div class='col-md-3 col-sm-3 col-xs-3'>
									<div class='alert alert-danger'>
										<a href='#' title='close' data-toggle='tooltip' class='close' data-dismiss='alert'>&times;</a>
										<img src='".substr($path.$file, 1, strlen($path.$file))."' class='img-thumbnail img-responsive' width='90' height='80'  alt='".$file."' />
										&nbsp;&nbsp;&nbsp;&nbsp;
										<a href='#' data-toggle='tooltip' title='Click to remove file permanently' onclick='removeImage(\"".strrev($type)."\", \"".$file."\")'>Remove</a>
									</div>
								</div>
								";
								} else{
									echo "No data found!<br />";
								}
							}
							$i++;
							if($i==4){
								echo "</div> <!-- div 01 -->";
								$i=0;
							} // --- end if cond
						} // --- end if cond
					} // --- end while
					echo "<div class='clearfix'></div>
					<br/><br />
					<div class='form-group'>
					<button class='btn btn-warning' title='Click to go back' data-toggle='tooltip' 
					type='button' onclick='getMenues()' >
					<i class='glyphicon glyphicon-arrow-left'> Back</i></button>
						<script>
						  $(document).ready(function (){
						    $('[data-toggle=\"tooltip\"]').tooltip();
						  });
						</script>";
					// echo "		
					// 	</div> <!-- row 01 -->
					//  </div> <!-- container 01 -->";
					closedir($dir);
				} // --- end if cond
			} // --- end if cond
			return false;
		} // --- end func
// ################################################################
// #	below function is displaying instruction 
// #		message before starting SCT-URDU
// ################################################################
		public static function displaySCT_MSGS($access=null){
			$MSG = null;
			if((isset($access)) && ($access != null)){
/*
* --- 1st argument = ( heading )
* --- 2nd argument = ( tooltip  for cancel )
* --- 3rd argument = ( alert-type /mean your message )
* --- 4th argument = ( paragraph message initial statement )
* --- 5th argument = ( mentioning any specific name or attr in strong )
* --- 6th argumrnt = ( second half of paragraph message )
* --- 7th argument = ( any special case include content )
*/
				switch($access){
					case 'SCTU':
						$MSG =
							"<div class='alert alert-warning'>".
							"<a href='#' class='close' data-toggle='tooltip' title='Close' data-dismiss='alert' onclick='getMenues()'>&times;</a>". 
							"<h1>Sentence Completion Test Urdu</h1>".
							"<h2><i class='glyphicon glyphicon-alert'> Instructions </i></h2>".
							"<p id='the_dnn_typed'></p>".
							"</div>".
							
							"<div class='clearfix'></div>
						<br/>
						<div class='form-group'>
							<button type='button' class='btn btn-info' data-toggle='tooltip' 
							title='Click to start test'  onclick='display_SCT_URDU()' >
							<i class='glyphicon glyphicon-edit'></i> Start Test</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type='button' class='btn btn-danger'  data-toggle='tooltip' title='Click to main menu' onclick='getMenues()' >
							<i class='glyphicon glyphicon-arrow-left'> Back </i> </button>
						</div>";
					break;
					case 'SCTE':
						$MSG =
							"<div class='alert alert-warning'>".
							"<a href='#' class='close' data-toggle='tooltip' title='Close' data-dismiss='alert' onclick='getMenues()'>&times;</a>". 
							"<h1>Sentence Completion Test English</h1>".
							"<h2><i class='glyphicon glyphicon-alert'> Instructions </i></h2>".
							"<p id='the_dnn_typed_ENG'></p>".
							"</div>".
							
							"<div class='clearfix'></div>
						<br/>
						<div class='form-group'>
							<button type='button' class='btn btn-info' data-toggle='tooltip' 
							title='Click to start test'  onclick='display_SCT_ENGLISH()' >
							<i class='glyphicon glyphicon-edit'></i> Start Test</button>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<button type='button' class='btn btn-danger'  data-toggle='tooltip' title='Click to main menu' onclick='getMenues()' >
							<i class='glyphicon glyphicon-arrow-left'> Back </i> </button>
						</div>";
					break;
				} // --- end switch
				echo $MSG;
			} // --- end if cond
		} // --- end func

// ###########################################################################
// # 		File Remove from PPDT 
// ###########################################################################
		public static function remove__Img($thePath=null, $access=null, $img=null, $type=null){
			// self::d("This is path : ".$thePath);
			// self::d("This is access : ".$access);
			// self::dd("This is image : ".$img);
			$dead__lock=1;
			$function_name=null;
			$dead__lock = ((($access != null) && ($access == AppConstant::PPDT_LIST_IMGS_CODE)) ? 0 : 1);
			if(isset($thePath) && ($thePath != null) && ($dead__lock == 0)){
				if(is_dir($thePath)){
					if(file_exists($thePath.$img)){
						if(unlink($thePath.$img)){
// ####################################
// #    deciding which function
// #	use for back opetion in app
// ####################################
			switch($type){
				case 'PPDT':
					$function_name = AppConstant::BACK_TO_PPDT;
				break;
				case 'SCTU':
					$function_name = AppConstant::BACK_TO_SCT_URDU;
				break;
				case 'SCTE':
					$function_name = AppConstant::BACK_TO_SCT_ENGLISH;
				break;
			} // --- end switch
/*
* --- 1st argument = ( heading )
* --- 2nd argument = ( tooltip  for cancel )
* --- 3rd argument = ( alert-type / mean your message )
* --- 4th argument = ( paragraph message initial statement )
* --- 5th argument = ( mentioning any specific name or attr in strong )
* --- 6th argumrnt = ( second half of paragraph message )
* --- 7th argument = ( any special case include content )
*/
						echo sprintf(AppConstant::APP_MESSAGE_TEMPLATE,
						"Delete Image",
						"Main menu",
						"<i class='glyphicon glyphicon-trash'></i>&nbsp;&nbsp;&nbsp;<span style='color:green;'>Success</span>",
						"The file ",
						"<span style='color:green;'>".$img."</span>",
						"has been deleted successfully.",
						"<div class='form-group'>
							<button class='btn btn-primary' data-toggle='tooltip' title='Back to delete' 
							onclick='".$function_name."'>Back </button>
						</div>" );
						} else{
							echo "Permission error!\n<br />You request does not have required priviliges";
						} // --- end if/else cond ( 0.4 )
					} else{
						echo 'file not found';
					} // --- end if/else ( 0.3 )
				} else{
					echo 'internal system problem';
				} // --- end if/else ( 0.2 )
				
			} else{
				echo 'path error';
			} // --- end if/else cond ( 0.1 )

		} // --- end func
// ########################################################################
// #	below function is displaying sentence steet
// #		for SCT URDU and ENGLISH
// #########################################################################
		public static function display_SCT_SHEETS($accsee=null, $type=null){
			$file = null; // temp variable use for nothing 
			$path = null; // contain path to the directory ( eather URDU/ENGLISH )
			$dir = null; // contains data inside whole directory
			$files = array(); // going to contain (each file name) in the directory
			$previous = null; // keeping previous record
			$MSG = ""; $HEADING = null; $i=0;
			if(isset($accsee) && ($accsee != null) && ($accsee == AppConstant::PPDT_LIST_IMGS_CODE)){
				if(isset($type) && ($type != null)){
					switch($type){
						case 'start_SCTU':
							// path to sentence completion test urdu-folder
							$path = AppConstant::SCT_U_PATH;	
							$HEADING = AppConstant::SCT_URDU_HEAD;
						break;
						case 'start_SCTE':
							// path to sentence completion test english-folder
							$path = AppConstant::SCT_E_PATH;
							$HEADING = AppConstant::SCT_ENG_HEAD;
						break;
					} // --- end switch
					// checking if folder exists or not
					if(is_dir($path)){
						$dir = opendir($path);
						while(($file = readdir($dir)) !== false){
							if(($file != ".") && ($file != "..")){
								if($file != ""){
								$files[$i] = $file;	
							} // --- end if cond [checking file not empty]
							} // --- end if [checking if file for not empty]
							$i++;
						} // --- end while
						$previous = $files[array_rand($files)];
						if(isset($_SESSION['previous']) && ($_SESSION['previous'] != "") && ($_SESSION['previous'] == $previous)){
							$previous = $files[array_rand($files)];
						}
						$_SESSION['previous'] = $previous;
						$MSG = "
								<div class='col-md-12 col-sm-12 col-xs-12'>
									<!-- ***** 1st column ( left-most ) contain sentence sheet ***** -->
									<div class='col-md-11 col-sm-11 col-xs-11'>
										<div class='panel panel-info'>
											<div class='panel-heading'>
												<h5>".AppConstant::WHITE_TXT_START.$HEADING.AppConstant::WHITE_TXT_END.AppConstant::WHITE_TXT_START." <span class='pull-right' id='counter_clock'></span>".AppConstant::WHITE_TXT_END."</h5>
											</div>
											<div class='panel-body'>
												<img src='issb/".$path.$previous."' alt='".$file."'  class='img-rounded' />
											</div>
										</div>
									</div>
									<!-- ##################################### -->
									<div class='clearfix'></div>
									<b />
									<div class='col-md-1 col-sm-1 col-xs-1'>
										<button class='btn btn-warning' title='Click to go back' data-toggle='tooltip' 
											type='button' onclick='getMenues()' >
										<i class='glyphicon glyphicon-arrow-left'> Back</i></button>
									</div>
									<script>
									var the_timer_interval;
										function myTimer(the_timer){
											var timer = the_timer, minutes, seconds;
											if(the_timer_interval != null){
												clearInterval(the_timer_interval);
											}
											the_timer_interval =  setInterval(
												function(){
													minutes = parseInt(timer / 60, 10);
													seconds = parseInt(timer % 60, 10);

													 minutes = minutes < 10 ? '0' + minutes : minutes;
        											 seconds = seconds < 10 ? '0' + seconds : seconds;
        											 if(document.getElementById('counter_clock') != null){
        											 	document.getElementById('counter_clock').innerHTML = '<h4>'+ minutes + ':' + seconds + '</h4>';
        											 } else{
        											 	clearInterval(the_timer_interval);
        											 }
        											  

											        if (--timer <= 0) {
											        	clearInterval(the_timer_interval);
											            timer = the_timer;
											        }
												}, 1000);
										} // --- end func
										myTimer((6*60));
									</script>
								</div>
								";
						echo $MSG;
					} // --- end if cond ( for chk-DIR )
				} // --- end inner if cond
			} // --- end if cond
		} // --- end func

// ############################################
// #	showing final message here after test
// ############################################

		public static function showFinal_MSG($is_finished=null, $pass=null, $type=null){
			$MSG = null;
			
			if(isset($is_finished) && ($is_finished==1) && (isset($pass)) && ($pass != null) && ($pass == AppConstant::APP_SECURITY_CODE)){
				if(isset($type) && ($type != "")){
					switch($type){
						case 'WORD_ASSOC_TEST_END':
							$MSG = sprintf(AppConstant::STOP_WRITTING_NOW,
									 "Word Association Test!",
									  "goToWAT()");
						break;
						case 'PIC_PERC_DESC_TEST_END':
							$MSG = sprintf(AppConstant::STOP_WRITTING_NOW,
									 "Picture Perception Description Test!",
									  "goToPPDT()");
						break;
						case 'SEN_COMP_TEST_ENGLISH_END':
							$MSG = sprintf(AppConstant::STOP_WRITTING_NOW,
									 "Sentence Cpmpletion English Test!",
									  "goToSCTE()");
						break;
						case 'SEN_COMP_TEST_URDU_END':
							$MSG = sprintf(AppConstant::STOP_WRITTING_NOW,
									 "Sentence Cpmpletion Urdu Test!",
									  "goToSCTU()");
						break;
					} // --- end switch cond
					echo $MSG;
				} // --- end if cond (inner)
			} // --- end if cond
		} // --- end func
	} // --- end class
	$main = new Main();

// ###########################################################################
// # 		when user enter application password
// ###########################################################################
if (isset($_GET['passid']) && ($_GET['passid'] != "")){
	$pass = htmlentities(($_GET['passid']));
	$main->evaluatePassword($pass);
}
// ###########################################################################
// #		all application menues are creating here
// ###########################################################################
if (isset($_GET['menues']) && ($_GET['menues'] != "")){
	$pass = htmlentities(($_GET['menues']));
	$main->makeMenues($pass);
}
// ###########################################################################
// #		displaying form to add a word in WAT file
// ###########################################################################
 if (isset($_GET['getWATField']) && ($_GET['getWATField'] != "")){
	$pass = htmlentities(($_GET['getWATField']));
	$main->addWord($pass);
}
// ###########################################################################
// # 			starting WAT randomly
// ###########################################################################
if (isset($_GET['showWat']) && ($_GET['showWat'] != "")){
	$pass = htmlentities(($_GET['showWat']));
	$main->displayWAT($pass);
}
// ###########################################################################
// # 			adding word in WAT file 
// ###########################################################################
if (isset($_GET['dnnAddWat']) && ($_GET['dnnAddWat'] != "") && (isset($_GET['watWord'])) && ($_GET['watWord'] != "")){
	$pass = htmlentities(($_GET['watWord']));
	$main->addWAT($pass);
}
// ###########################################################################
// # 			displaing all words in a select field
// ###########################################################################
if (isset($_GET['deleteWAT']) && ($_GET['deleteWAT'] != "") ){
	$pass = htmlentities(($_GET['deleteWAT']));
	$main->removeWord();
}
// ###########################################################################
// # 			getting selected word and removing it from WAT file
// ###########################################################################
if (isset($_GET['deleteWAT']) && ($_GET['deleteWAT'] != "") && ($_GET['deleteWAT'] == 11) && (isset($_GET['del_WAT'])) && ($_GET['del_WAT'] != "") ){
	$pass = htmlentities(($_GET['del_WAT']));
	// echo "i am here <br />
	// <botton class='btn btn-primary' oncliock='getMenues()'>Go Back </button>
	// ";
	$main->deleteWAT($pass);
}
// ###########################################################################
// # 			displaying instruction msg befire PPDT
// ###########################################################################
if (isset($_GET['startPPDT']) && ($_GET['startPPDT'] != "") ){
	$pass = htmlentities(($_GET['startPPDT']));
	$main->displayPPMsg($pass);
}
// ###########################################################################
// # 			displaying images for PPDT
// ###########################################################################
if (isset($_GET['displayPPDT']) && ($_GET['displayPPDT'] != "") ){
	$pass = htmlentities(($_GET['displayPPDT']));
	$main->displayImages($pass);
}
// ###########################################################################
// # 			displaying start writting msg for PPDT
// ###########################################################################
if (isset($_GET['showWrtMsg']) && ($_GET['showWrtMsg'] != "") ){
	$pass = htmlentities(($_GET['showWrtMsg']));
	$main->startWriting($pass);
}
// ###########################################################################
// # 			displaying upload image function
// ###########################################################################
if (isset($_GET['showUploadFrm']) && ($_GET['showUploadFrm'] != "") && (isset($_GET['uploadType'])) && ($_GET['uploadType'] != "") ){
	$pass = htmlentities(($_GET['showUploadFrm']));
	$type = strrev($_GET['uploadType']);
	$main->updloadForm($pass, $type);
}
// ###########################################################################
// # 			displaying all images in PPDT function
// ###########################################################################
if (isset($_GET['showUploadedImgs']) && ($_GET['showUploadedImgs'] != "") ){
	$pass = strrev(($_GET['fileTypeAccess']));
	$type = strrev($_GET['showUploadedImgs']);
	$l_path = null;
	switch($type){
		case 'PPDT':
			$l_path = AppConstant::PPDT_PATH;
		break;
		case 'SCTU':
			$l_path = AppConstant::SCT_U_PATH;
		break;
		case 'SCTE':
			$l_path = AppConstant::SCT_E_PATH;
		break;
	} // --- end switch
	$main->list_All_PPDT($l_path, $pass, $type);
}

// ###########################################################################
// # 			getting an images name and deleting in PPDT function
// ###########################################################################
if (isset($_POST['image_name']) && ($_POST['image_name'] != "") 
	&& (isset($_POST['DNN_type'])) && (isset($_POST['hashed'])) 
	&& (strrev($_POST['hashed']) == AppConstant::PPDT_LIST_IMGS_CODE)){
	$pass = strrev($_POST['hashed']);
	$type = strrev($_POST['DNN_type']);
	$path = null;
	switch($type){
		case 'PPDT':
			$path = AppConstant::PPDT_PATH;
		break;
		case 'SCTU':
			$path = AppConstant::SCT_U_PATH;
		break;
		case 'SCTE':
			$path = AppConstant::SCT_E_PATH;
		break;
	} // --- end switch
	$main->remove__Img($path, $pass, $_POST['image_name'], $type);
}

// ###########################################################################
// # 			getting all images name and listing it in blocks
// ###########################################################################
if (isset($_POST['image_name']) && ($_POST['image_name'] != "") && (isset($_POST['DNN_pass'])) && ( strrev($_POST['DNN_pass']) == 'SCTU') ){
	$pass = strrev($_POST['DNN_pass']);
	$main->remove_PPDT_Img(AppConstant::SCT_U_PATH, $pass, $_POST['image_name']);
}
// ###########################################################################
// # 			displaying instruction msg befire starting SCT-URDU
// ###########################################################################
if (isset($_GET['startSCT']) && ($_GET['startSCT'] != "") ){
	$pass = htmlentities(strrev($_GET['startSCT']));
	$access=null;
	switch($pass){
		case 'SCTU':
			$access = $pass;
		break;
		case 'SCTE':
			$access = $pass;
		break;
	} // --- end switch
	$main->displaySCT_MSGS($access);
}
// ###########################################################################
// # 			displaying exam sheet SCT-URDU
// ###########################################################################
if (isset($_GET['startSCT']) && ($_GET['startSCT'] != "") && (isset($_GET['DNN_access'])) && ($_GET['DNN_access'] != "") ){
	$type = htmlentities(strrev($_GET['startSCT']));
	$access=htmlentities(strrev($_GET['DNN_access']));
	switch($type){
		case 'start_SCTU':
			$main->display_SCT_SHEETS($access, $type);
		break;
		case 'start_SCTE':
			$main->display_SCT_SHEETS($access, $type);
		break;
	} // --- end switch
	$main->displaySCT_MSGS($access);
} 
// ##########################################################
// #			final message will be show
// #	through below function after finishing the test
// ##########################################################
if((isset($_GET['dnn_test_finished'])) && (isset($_GET['dnn_access_code'])) 
	&& ($_GET['dnn_access_code'] != "") && (isset($_GET['dnn_test_type'])) && ($_GET['dnn_test_type'] != "")){
	$type = htmlentities(strrev($_GET['dnn_test_type']));
	$is_finished = (($_GET['dnn_test_finished'] == 'yes') ? 1:0);
	$pass = htmlentities(strrev($_GET['dnn_access_code']));
	// Main::d("this is is_finished : ".$is_finished);
	// Main::d("this is pass : ".$pass);
	// Main::d("*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*#*##*");
	// Main::dd("this is type : ".$type);
	$main->showFinal_MSG($is_finished, $pass, $type);
}
// ##########################################################
// #			final message will be show
// #	through below function after finishing the test
// ##########################################################
if((isset($_GET['WAT_access'])) && (isset($_GET['DNN_access'])) 
	&& ($_GET['WAT_access'] != "") && ($_GET['DNN_access'] != "")){
	// Main::d('here');
	$access = htmlentities(strrev($_GET['WAT_access']));
	$pass = htmlentities(strrev($_GET['DNN_access']));
	// Main::d($access);
	// Main::d($pass);
	if(($pass != "") && ($pass == AppConstant::APP_SECURITY_CODE)){
		// Main::dd('here in the if cond');
		$main->show_WAT_MSG($access);
	} else{
		echo sprintf(AppConstant::APP_MESSAGE_TEMPLATE, 
			"Access Blocked!",
			"Back to main menu",
			"Authentication not confirmed to display this secret content!",
			"Try to refresh the app by clicking provided refresh button.",
			"", "", "");
	}
	
}
?>