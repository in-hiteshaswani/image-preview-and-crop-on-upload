<!--

* File Reader is a Web API lets web applications asynchronously read the contents of files (or raw data buffers) stored on the user's computer.

* File objects may be obtained from a FileList object returned as a result of a user selecting files using the <input> element.

* File Reader result contains the file contents and this property is only valid after the read operation is complete.

* FileReader.onload event is triggered each time the reading operation is successfully completed.

* FileReader.readAsDataURL() - Starts reading the contents of the specified Blob, once finished, the result attribute contains a data: URL representing the file's data.

* FileReader.readAsText() - Starts reading the contents of the specified Blob, once finished, the result attribute contains the contents of the file as a text string.

-->
<html>
	<head>
		<title>Upload Image Preview</title>
		<style>
			.wrapper{
				height: 300px;
				width: 300px;
				margin: 100px auto 0px;
				background-color: #fafafa;
				position: relative;
				text-align: center;
				border: 1px solid #777;
			}
			#preview{
				height: 200px;
				margin: 30px auto 0px;
			}
			input[type="file"]{
				position: absolute;
				bottom: 20px;
				left: 60px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<form>
				<img id="preview">
				<input type="file" accept="image/*" id="photo_upload" onchange="previewFile(event)"/>
			</form>
		</div>
		<script>
			function previewFile(event){

				// Image extension validation using Regular Expressions

				var allowedFiles = [".png", ".jpeg", ".jpg"];

				var photo_pattern = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

				var photo = document.getElementById("photo_upload");

				if(!photo_pattern.test(photo.value.toLowerCase())){

					alert("Upload " + allowedFiles.join(', ') + " files only.");
					photo.value = "";
					photo.focus();
					return false;

				}

				// File Reader API

				// Taking the reference of HTML element that triggered the event 

				var input = event.target;

				var reader = new FileReader();

				reader.onload = function(){

					var dataURL = reader.result;

					var preview = document.getElementById("preview");
					preview.src = dataURL;

				};

				reader.readAsDataURL(input.files[0]);

			}
		</script>
	</body>
</html>