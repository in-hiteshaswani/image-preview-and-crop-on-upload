<html>
	<head>
		<title>Upload Image Preview</title>
		<link rel="stylesheet" href="./croppie/croppie.css"></link>
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
			#crop_btn{
				display: block;
				height: 40px;
				width: 70px;
				margin: 40px auto 0px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<form>
				<img id="preview">
				<input type="file" accept="image/*" id="photo_upload" onchange="previewFile(event)" multiple/>
			</form>
		</div>
		<input type="button" value="Crop" onclick="crop_image()" id="crop_btn"/>
		<script src="./croppie/croppie.js"></script>
		<script>

			var cropped_image;

			var preview = document.getElementById("preview");
			var photo = document.getElementById("photo_upload");

			var crop_btn = document.getElementById("crop_btn");
			crop_btn.style.display = "none";

			function previewFile(event){

				// Image extension validation using Regular Expressions

				var allowedFiles = [".png", ".jpeg", ".jpg"];

				var photo_pattern = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");

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

					preview.src = dataURL;

					cropped_image = new Croppie(document.getElementById('preview'), {
						viewport: {
					        width: 200,
					        height: 200,
					        type: 'square'
					    },
					    boundary: {
					        width: 300,
					        height: 300
					    }
					});

					crop_btn.style.display = "block";

				};

				reader.readAsDataURL(input.files[0]);


			}

			function crop_image(){

				cropped_image.result('base64').then(function(dataURL) {
				    preview.src = dataURL;
				    photo.value = dataURL;
				    console.log(dataURL);
				});

				cropped_image.destroy();

				crop_btn.style.display = "none";

			}
		</script>
	</body>
</html>