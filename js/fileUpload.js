	


	function fileUpload(){ // this function 
		var rawFiles = document.getElementById('theUploads').files;
		// alert(rawFiles);
		if((rawFiles != undefined) && (rawFiles != "")){
			handleFiles(rawFiles);
		} // end if
	} // --- end func


function handleFiles(Files){
	for(var i=0; i<Files.length; i++){
		var file = Files[i];	
		var imageType = /^image\//;

		// checking image file type
		if(imageType.test(file.type)){
			continue;
		} // --- end if

		// creating run-time display-able element to tumbnail the uploading file
		var img = document.createElement('img');
		img.classList.add('obj');
		img.file = file;
		// we are assuming that "preview" is the div output where the content will be displayed.
		preview.appendChild(img);

		var reader = new FileReader();
		reader.onload = (function (aImg){ return function(e){aImg.src = a.target.result;};})(img);
		reader.readAsDataURL(file);

	} // --- end for loop
} // --- end func

// ###############################################################
// #	file drag and drop functionality 
// #		is defined below
// ################################################################	

$('#dropbox').on('dragover', function(e){
	var dropbox;

dropbox = document.getElementById("dropbox");
dropbox.addEventListener("dragenter", dragenter, false);
dropbox.addEventListener("dragover", dragover, false);
dropbox.addEventListener("drop", drop, false);
});


	function dragenter(e){ // when drag is enter the box
		e.stopPropagation();
		e.preventDefault();
	} // --- end func ( drag-enter )


	function dragout(e){
		e.stopPropagation();
		e.preventDefault();
	} // --- end func ( drag-out )

	function drag(e){
		e.stopPropagation();
		e.preventDefault();

		var data_t = e.dataTransfer;
		var Files  = data_t.files;
			handleFiles(Files); // function has been called which is the main function
	} // --- end function ( drag )