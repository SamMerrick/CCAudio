<?php
include("views/header.php");
?>

<div id="submissions">
	<div id="uploadform" >
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="uploadform"> 
			
			<div class="column">
				<h4>Upload your music</h4>

				<input name="file" class="" type="file" /><br /> <br>
				<input name="track" type="text" placeholder="Track Name">
				<textarea name="description" placeholder="Description" ></textarea>
				<input name="genre" type="text" placeholder="Genre">

				
				<h5>License</h5>
				<select name="license">	
					<option value="0">Public Domain</option>
					<option value="1">Attribution</option>
					<option value="2">Attribution-Sharealike</option>
					<option value="3">Attribution-Noderivs</option>
					<option value="4">Attribution-Noncommercial</option>
					<option value="5">Attribution-Noncommercial-Sharealike</option>
					<option value="5">Attribution-Noncommercial-Noderivs</option>
				</select>
			</div>
				
			<div class="column">	
				<h4>Album Art</h4>
				
				<input name="album" class="custom-file-input" type="file" accept="image/*" onchange="loadFile(event)">
				<img id="output"/>
				
			</div>
			
			<input name="submit" type="submit" value="Upload" />
		</form>
			
		<?php
			include("assets/php/uploadscript.php");
			if (isset($_POST['submit'])) {
				$file = uploadFile('file', false, true);
				

				if (is_array($file['error'])) {
					$message = '';
					foreach ($file['error'] as $msg) {
						$message .= '<p>'.$msg.'</p>';    
					}
				} 
				else {
					$message = "File uploaded successfully";
				}
				echo $message;
			}
		?>
	</div>
 
</div>	

<script>				
				
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>