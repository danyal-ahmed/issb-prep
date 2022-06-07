
	var startShow ;
    var startWrtShow;
    var startSCTU_show;
    var server = './php/Main.php';
    var exitGate = './php/logout.php';
	
// ***************************************************
// *    checking login status
// *        for user here below
// ***************************************************
    var state;
    function loginStatus(){
        $.ajax({
            url : exitGate,
            data: {
                dn_status : 'unknown'
            },
            type: 'POST'
        })
    } // --- end func

    function goToWAT(){
		// alert("this is WAT");
		var num = 0;
		num = num+1;
		$.ajax({
            url : server,
            data : {
                showWat : 1,
            },
            type : 'GET'
        }) .done( function(respond){
        	beep();
            showOption(respond+'<div class="pull-right"><button class="btn btn-danger" onclick="getMenues()">Go Back</button></div>');
           startShow =  setInterval( function (){
            	if(num < 77){
            		$.ajax({
		            url : server,
		            data : {
		                showWat : 1,
		            },
		            type : 'GET'
		        }) .done( function(respond){
		        	beep();
		        	num = num+1;
		            showOption(respond+'<div class="pull-right"><button class="btn btn-danger" onclick="getMenues()">Go Back </button></div>');
		        }) .fail( function (error) {
		        	alert("didn't get");
		        });
            	} else{ // === all 77 words has been printed and test is finished
            		num = 0;
            		// getMenues();
                    // calling test finished
                     finish_SC_Tests("DNE_TSET_COSSA_DROW");
            		clearInterval(startShow);
            	}
            	
            }, 6500);
        }) .fail( function (error) {
        	appError(error);
        });
	} // --- end func

	function goToPPDT(){
		$.ajax({
            url : server,
            data : {
                startPPDT : 1,
            },
            type : 'GET'
        }) .done( function(respond){
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
	} // --- end func

    function showPPDT(){
        
        $.ajax({
            url : server,
            data : {
                displayPPDT : 1,
            },
            type : 'GET'
        }) .done( function(respond){

            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
    } // --- end func
    var myCounter = 0;
    var flag=0;
    function procedPPDT(){
        
        console.log("The counter is : "+myCounter+"\nIt is number : "+isNaN(myCounter));
        // --- checking counter for number of execution's
        if(myCounter >= 5 ){
            // --- resetting counter and flag
            myCounter = 0; flag=0;
            // getMenues(); // --- call app main menu
            // call final finishing message
            finish_SC_Tests("DNE_TSET_CSED_CREP_CIP");
        }
        // --- checking flag
        else if(flag == 0){
            beep(); // --- alerting here by beep
            showPPDT(); // --- showing picture here
            // --- increment global counter below
            myCounter = myCounter+1; 
            /* 
             * set timer for update flag and recall
             * the function itself below
             */
            startShow = setTimeout(function(){ 
                flag = 1; // --- updated flag
                procedPPDT();// --- call function itself
             }, 30000);
            
         } else if(flag == 1){
            beep(); // --- alerting here by beep
            showWrtMsg(); // --- showing instruction msg here
            startShow = setTimeout(function(){
                // --- updating flag below
                flag = 0;
                procedPPDT();// --- call function itself again
            }, 180000); // ==================================================== test writting time
         } // --- end if/else cond here
        
    } // --- end func

function showWrtMsg(counter){
   
    $.ajax({
            url : server,
            data : {
                showWrtMsg : 1,
            },
            type : 'GET'
        }) .done( function(respond){

            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
} // --- end func
// *************************************************************
// * displaying instruction message for SCT-URDU
// *************************************************************
	function goToSCTU(){
		
        $.ajax({
            url : server,
            data : {
                startSCT : "UTCS",
            },
            type : 'GET'
        }) .done( function(respond){
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
	} // --- end func
// *************************************************************
// * displaying instruction message for SCT-URDU
// *************************************************************
var count_SCT_URDU =1;
var SCT_URDU_FLAG=0 ;

    function display_SCT_URDU(){
        clearInterval(startSCTU_show); 

        if((SCT_URDU_FLAG == 0) && (count_SCT_URDU < 2)){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:green;");
            beep(); // --- playing beep sound
            display_Sheet_SCTU(); // --- displaying sentence sheet here

            // waiting for 6 minutes approx
            startSCTU_show = setInterval(function (){
                SCT_URDU_FLAG = 1;
                count_SCT_URDU = count_SCT_URDU+1;
                display_SCT_URDU(); // --- call function itself
            }, 360000);
        } else if((SCT_URDU_FLAG == 1) && (count_SCT_URDU == 2)){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:brown;");
            beep(); // --- playing beep sound
            display_Sheet_SCTU(); // --- displaying sentence sheet here
            startSCTU_show = setInterval(function(){
                SCT_URDU_FLAG = 0;
                count_SCT_URDU = count_SCT_URDU +1;    
                display_SCT_URDU();
            }, 360000);
            
        } else if(count_SCT_URDU > 2){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:violet;");
            clearInterval(startSCTU_show);
                finish_SC_Tests("DNE_UDRU_TSET_PMOC_NES");
            } // --- end if/else cond// --- end if/else cond
        
    } // --- end func
     function display_Sheet_SCTU(){
        $.ajax({
            url : server,
            data : {
                startSCT : "UTCS_trats",
                DNN_access : '12219ayiruG_NND',
            },
            type : 'GET'
        }) .done( function(respond){
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
    } // --- end func
// ***********************************************************
// * displaying sentence completion test 
// *    in ENGLISH
// ***********************************************************
    function display_SCT_ENGLISH(){
        // we are clearing any time-interval function running
        clearInterval(startSCTU_show); 

        if((SCT_URDU_FLAG == 0) && (count_SCT_URDU < 2)){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:green;");
            beep(); // --- playing beep sound
            display_Sheet_SCTE(); // --- displaying sentence sheet here

            // waiting for 6 minutes approx
            startSCTU_show = setInterval(function (){
                SCT_URDU_FLAG = 1;
                count_SCT_URDU = count_SCT_URDU+1;
                display_SCT_ENGLISH(); // --- call function itself
            }, 360000);
        } else if((SCT_URDU_FLAG == 1) && (count_SCT_URDU == 2)){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:brown;");
            beep(); // --- playing beep sound
            display_Sheet_SCTE(); // --- displaying sentence sheet here
            startSCTU_show = setInterval(function(){
                SCT_URDU_FLAG = 0;
                count_SCT_URDU = count_SCT_URDU +1;    
                display_SCT_ENGLISH();
            }, 360000);
            
        } else if(count_SCT_URDU > 2){
            console.log("%cValue of count_SCT_URDU : "+count_SCT_URDU,"color:violet;");
            clearInterval(startSCTU_show);
                finish_SC_Tests("DNE_HSILGNE_TSET_PMOC_NES");
            } // --- end if/else cond// --- end if/else cond
        
    } // --- end func
    function display_Sheet_SCTE(){
        $.ajax({
            url : server,
            data : {
                startSCT : "ETCS_trats",
                DNN_access : '12219ayiruG_NND',
            },
            type : 'GET'
        }) .done( function(respond){
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
    } // --- end func

    function finish_SC_Tests(testType){
        count_SCT_URDU  = 1; // reset counter for SCT-URDU/ENGLISH
        SCT_URDU_FLAG=0; // reset the test flag here ( SCT U/E )
        if((the_timer_interval != "") || (the_timer_interval != undefined) || (the_timer_interval != null)){
            clearInterval(the_timer_interval);    
            }
            clearInterval(startShow); // --- clear any time stamp running
            clearTimeout(startShow); // --- clear any further time stamp
            // --- resetting counter and flag
            myCounter = 0; flag=0;
            clearInterval(startSCTU_show); // --- clear any time stamp running

        showFinal_MSG(testType);
        // getMenues();
    }



	function goToSCTE(){

		$.ajax({
            url : server,
            data : {
                startSCT : "ETCS",
            },
            type : 'GET'
        }) .done( function(respond){
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
	} // --- end func


	function passwordGet(){
		var password = document.getElementById('passAccess').value;
		if((password != undefined) && (password != "")){
			// alert('found');
			$.ajax({
            url : server,
            data : {
                passid : password,
            },
            type : 'GET'
        }) .done( function(respond){
            // alert(respond);
            location.reload(true);
            showOption(respond);
            
        }) .fail( function (error) {
        	appError(error);
        });
		} else{
			appError('not found');
		} // --- end if cond
	} // --- end func
// ***************************************************************************
// *        below function is  showing instruction
// *            message before starting WORD-ASSOCIATION-TEST
// ***************************************************************************
    function show_WAT_MSGS(){
        $.ajax({
            url : server,
            data : {
                WAT_access : "wohs_TAW_egassem",
                DNN_access : '12219ayiruG_ireM_NND',
            },
            type : "GET"
        })
        .done(function (theRespond){
            showOption(theRespond);
        }) .fail( function (error){
            appError(error);
        });
    } // end function
		function showOption(respond){
			// document.getElementById('mainDiv').innerHTML = respond;
            // $("#mainDiv").html(respond);
             $('#mainDiv').html(
                    '<div class="alert alert-danger">'
                        +'<div class="panel panel-warning">'
                            +'<div class="panel-heading">'
                                +'<h2 class="whiteColor"><span style="text-shadow:2px 3px 2px black;">MAIN MENU</span> <a href="#" onclick="getMenues()" data-toggle="tooltip" title="Refresh App" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-refresh"></i></a></h2>'
                            +'</div>'
                         +'<div class="panel-body">'
                         +respond
                         +'</div> </div> </div>'
                    );
             $('[data-toggle="tooltip"]').tooltip();


            
             if($('#the_dnn_typed').length > 0){ // [ displaying instruction msg for SCT-URDU ]
                var SCTU = new TypeIt('#the_dnn_typed', {
                      speed: 50,
                      html: true,
                      lifeLike: true,
                      autoStart:false,
                      })
                      .type('<li>You will have 2 sentence sheets.</li>')
                      .pause(500)
                      .type('<li>You have to complete all sentences in 6 minutes.</li>')
                      .pause(500)
                      .type('<li>All Sentences would be in URDU language.</li>')
                      .pause(500)
                      .type('<li>Each sheet will contain more than 10 sentences. </li>')
                      .pause(500)
                      .type('<li>After 6 minutes another sheet will be automatically displayed.</li>')
                      .pause(500)
                      .type('<br />')
                      .type('Click <strong>Start test button </strong> to continue')
                      .pause(500)
                      .options({speed:700})
                      .pause(500)
                      .type('.....');
                      } // --- end if cond [ displaying instruction msg for SCT-URDU ]

                      if($('#the_dnn_typed_ENG').length > 0){ // [ displaying instruction msg for SCT-URDU ]
                      var SCTU = new TypeIt('#the_dnn_typed_ENG', {
                      speed: 50,
                      html: true,
                      lifeLike: true,
                      autoStart:false,
                      })
                      .type('<li>You will have 2 sentence sheets.</li>')
                      .pause(500)
                      .type('<li>You have to complete all sentences in 6 minutes.</li>')
                      .pause(500)
                      .type('<li>All Sentences would be in ENGLISH language.</li>')
                      .pause(500)
                      .type('<li>Each sheet will contain more than 10 sentences. </li>')
                      .pause(500)
                      .type('<li>Attempt sentences as many as you can. </li>')
                      .pause(500)
                      .type('<li>After 6 minutes another sheet will be automatically displayed.</li>')
                      .pause(500)
                      .type('<br />')
                      .pause(500)
                      .type('Click <strong>Start test button </strong> to continue.')
                      .pause(500)
                      .options({speed:700})
                      .pause(500)
                      .type('.....');
                      } // --- end if cond [ displaying instruction msg for SCT-URDU ]
            $('#WAT-font').css("font-size", "65px");
            $('#WAT-font').css("font-family", "Times New Roman");
            $('#WAT-font').css("font-weight", "bold");
            $('.burning').burn({
                k: 10,
                w: 10
            });
            // typing text by DNN here executing   ( dnn_type_here )
            if($("#dnn_typed").length > 0){
            } // --- end if cond
            // $("#menu_button").css("box-shadow","2px 2px 4px black");
            $("#menu_button").css("box-shadow", "2px 2px 5px black");
            $("#wat_01").css("background", "#da473d");
            $("#wat_01").css("color", "#fff");
            // button o2
            $("#menu_button_01").css("box-shadow", "2px 2px 5px black");
            $("#wat_02").css("background", "#e76a00");
            $("#wat_02").css("color", "#fff");
            // button 03 
            $("#menu_button_02").css("box-shadow", "2px 2px 5px black");
            $("#wat_03").css("background", "#ebc452");
            $("#wat_03").css("color", "#fff");
            // button 04 
            $("#menu_button_03").css("box-shadow", "2px 2px 5px black");
            $("#wat_04").css("background", "#da473d");
            $("#wat_04").css("color", "#fff");
            $("#menu_button_04").css("box-shadow", "2px 2px 5px black");
		} // --- end func
var the_timer_interval;
		function getMenues(){

            if((the_timer_interval != "") || (the_timer_interval != undefined) || (the_timer_interval != null)){
            clearInterval(the_timer_interval);    
            }

			clearInterval(startShow); // --- clear any time stamp running
            clearTimeout(startShow); // --- clear any further time stamp
            // --- resetting counter and flag
            myCounter = 0; flag=0;
            clearInterval(startSCTU_show); // --- clear any time stamp running
			$.ajax({
            url : server,
            data : {
                menues : 1,
            },
            type : 'GET'
        }) .done( function(respond){
            // alert(respond);
            showOption(respond);
        }) .fail( function (error) {
        	appError(error);
        });
		
	} // --- end func


	// the below function is responsible for beep 
	function beep(){
		 var sound = new  Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU="); 
		 sound.play();
	} // --- end func

	function goToAddWAT(){
		$.ajax({
            url : server,
            data : {
                getWATField : 1,
            },
            type : 'GET'
        }) .done( function(respond){
            // alert(respond);
            showOption(respond);
        }) .fail( function (error) {
        	appError(error);
        });
	} // --- end func

function addWAT(){
	var myWord = document.getElementById('addWAT').value;
	if((myWord != undefined) && (myWord != "")){
		$.ajax({
            url : server,
            data : {
                dnnAddWat : 1,
                watWord : myWord,
            },
            type : 'GET'
        }) .done( function(respond){
            // location.reload(true);
            showOption(respond);
        }) .fail( function (error) {
        	appError(error);
        });	
	} // --- end func
} // --- end func

function goLogout(){
	$.ajax({
            url : exitGate,
            data : {
                dnnLogout : 1,
            },
            type : 'POST'
        }) .done( function(respond){
               location.reload(true);
                showOption(respond);
        }) .fail( function (error) {
        	   appError(error);
        });
} // --- end func

    function goToDeleteWAT(){
        $.ajax({
            url : server,
            data : {
                deleteWAT : 1,
            },
            type : 'GET'
        }) .done( function(respond){
            
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
        });
} // --- end func

function delWAT(){
    var objWAT = document.getElementById('deleteWAT');
    var delWAT = objWAT.options[objWAT.selectedIndex].value;
    // alert(delWAT);
    $.ajax({
            url : server,
            data : {
                deleteWAT : 11,
                del_WAT : delWAT,
            },
            type : 'GET'
        }) .done( function(respond){
            
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
    });
} // --- end func

function uploadPPDT(){
    $.ajax({
            url : server,
            data : {
                showUploadFrm : "91221dnn",
                uploadType : 'TDPP',
            },
            type : 'GET'
        }) .done( function(respond){
            
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
    });
} // --- end func

function appError(error){
    $('#mainDiv').html(
        '<div class="alert alert-danger">'
            +'<div class="panel panel-warning">'
                +'<div class="panel-heading">'
                    +'<h2> Error <a href="#" class="close" data-dismiss="alert">&times;</a></h2>'
                +'</div>'
                     +'<div class="panel-body">'
                         +'<strong>Stop!</strong>'
                             +' An error occured, DNN > server > file : <strong>'+error+'</strong>'
                                +' has been failed to delete'
                    +'</div> </div> </div>'
    );
} // -- end func

// ##################################################
// # here below fuction is displaying
// #    all file uploaded by user in ( PPDT )
// ###################################################

    function removePPDT(){
       $.ajax({
            url : server,
            data : {
                showUploadedImgs : 'TDPP',
                fileTypeAccess : '12219ayiruG_NND'
            },
            type : 'GET',
       }) .done(function (respond){
            // showOption(respond);
            $('#mainDiv').html(
                    '<div class="alert alert-danger">'
                        +'<div class="panel panel-warning">'
                            +'<div class="panel-heading">'
                                +'<h2 class="whiteColor"> Collected files <a href="#" title="Back to main menu" data-toggle="tooltip" onclick="getMenues()" class="close" data-dismiss="alert">&times;</a></h2>'
                            +'</div>'
                         +'<div class="panel-body">'
                         +'<strong>'+respond+'</strong>'
                         +'</div> </div> </div>'
                    ); // --- end html() tag
            $('[data-toggle="tooltip"]').tooltip(); // --- starting tooltip here again
       }) .fail(function (error){});
    } // --- end func
// ##################################################
// #    here below fuction is getting  ( delete )
// #       file name by user and POST it to php ( PPDT )
// ###################################################
   function removeImage(type, file){
        if((file != undefined) && (file != null) && (file != "")){
            if((type != "") && (type != undefined) && (type != null) ){
                $.ajax({
                url : server,
                data : { 
                    image_name : file,
                    DNN_type : type,
                    hashed : '12219ayiruG_NND',
                     },
                type: 'POST',
                })  .done(function (respond){
                        showOption(respond);
                }) .fail(function (error){
                    $('#mainDiv').html(
                        '<div class="alert alert-danger">'
                            +'<div class="panel panel-info">'
                                +'<div class="panel-heading">'
                                    +'<h2> Error Occured <a href="#" class="close" data-dismiss="alert">&times;</a></h2>'
                                +'</div>'
                             +'<div class="panel-body">'
                             +'<strong>Stop!</strong>'
                             +' An error occured, DNN > server > file : <strong>'+file+'</strong>'
                             +' has been failed to delete'
                             +'</div> </div> </div>'
                        );
                });
            } // --- end inner if cond
        } // --- end if cond
   } // --- end func 
// **********************************************************
// *    below function is displaying upload form
// *        for SCT-URDU
// **********************************************************
    function upload_SCTU_File(){

        $.ajax({
            url : server,
            data : {
                showUploadFrm : "91221dnn",
                uploadType : 'UTCS',
            },
            type : 'GET'
        }) .done( function(respond){
            
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
    });
    } // --- end func


// **********************************************************
// *    below function is displaying upload form
// *        for SCT-ENGLISH
// **********************************************************
    function upload_SCTE_File(){
        
        $.ajax({
            url : server,
            data : {
                showUploadFrm : "91221dnn",
                uploadType : 'ETCS',
            },
            type : 'GET'
        }) .done( function(respond){
            
            showOption(respond);
        }) .fail( function (error) {
            appError(error);
    });
    } // --- end func
// ##################################################
// # here below fuction is displaying
// #    all file uploaded by user in ( SCT_URDU )
// ###################################################

    function removeSCT_URDU(){
       $.ajax({
            url : server,
            data : {
                showUploadedImgs : 'UTCS',
                fileTypeAccess : '12219ayiruG_NND'
            },
            type : 'GET',
       }) .done(function (respond){
            // showOption(respond);
            $('#mainDiv').html(
                    '<div class="alert alert-danger">'
                        +'<div class="panel panel-warning">'
                            +'<div class="panel-heading">'
                                +'<h2 class="whiteColor"> Collected files <a href="#" title="Back to main menu" data-toggle="tooltip" onclick="getMenues()" class="close" data-dismiss="alert">&times;</a></h2>'
                            +'</div>'
                         +'<div class="panel-body">'
                         +'<strong>'+respond+'</strong>'
                         +'</div> </div> </div>'
                    ); // --- end html() tag
            $('[data-toggle="tooltip"]').tooltip(); // --- starting tooltip here again
       }) .fail(function (error){});
    } // --- end func

// ##################################################
// # here below fuction is displaying
// #    all file uploaded by user in ( SCT_URDU )
// ###################################################
    
    function removeSCT_ENGLISH(){
       $.ajax({
            url : server,
            data : {
                showUploadedImgs : 'ETCS',
                fileTypeAccess : '12219ayiruG_NND'
            },
            type : 'GET',
       }) .done(function (respond){
            // showOption(respond);
            $('#mainDiv').html(
                    '<div class="alert alert-danger">'
                        +'<div class="panel panel-warning">'
                            +'<div class="panel-heading">'
                                +'<h2 class="whiteColor"> Collected files <a href="#" title="Back to main menu" data-toggle="tooltip" onclick="getMenues()" class="close" data-dismiss="alert">&times;</a></h2>'
                            +'</div>'
                         +'<div class="panel-body">'
                         +'<strong>'+respond+'</strong>'
                         +'</div> </div> </div>'
                    ); // --- end html() tag
            $('[data-toggle="tooltip"]').tooltip(); // --- starting tooltip here again
       }) .fail(function (error){});
} // --- end func
// ****************************************************
// *    show final message 
// *        after test completion
// ****************************************************
    function showFinal_MSG(myType){
        $.ajax({
            url : server,
            data : {
                dnn_test_finished : 'yes',
                dnn_access_code : '12219ayiruG_ireM_NND',
                dnn_test_type : myType,
            },
            type : 'GET',
       }) .done(function (respond){
            // showOption(respond);
            $('#mainDiv').html(
                    '<div class="alert alert-danger">'
                        +'<div class="panel panel-warning">'
                            +'<div class="panel-heading">'
                                +'<h2 class="whiteColor"> STOP WRITTING! <a href="#" title="Back to main menu" data-toggle="tooltip" onclick="getMenues()" class="close" data-dismiss="alert">&times;</a></h2>'
                            +'</div>'
                         +'<div class="panel-body">'
                         +'<strong>'+respond+'</strong>'
                         +'</div> </div> </div>'
                    ); // --- end html() tag
            $('[data-toggle="tooltip"]').tooltip(); // --- starting tooltip here again
       }) .fail(function (error){ appError(error); });
    } // --- end func
    