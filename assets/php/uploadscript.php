<?php

function uploadFile ($file_field = null, $check_image = false, $random_name = false) {
       
  //Set file upload path
  $path = 'upload/'; 
  $max_size = 100000000;
  $whitelist_ext = array('mp3');
  $whitelist_type = array('audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio');

  // Create an array to hold any output
  $out = array('error'=>null);
               
  if (!$file_field) {
    $out['error'][] = "Please specify a valid form field name";           
  }

  if (!$path) {
    $out['error'][] = "Please specify a valid upload path";               
  }
       
  if (count($out['error'])>0) {
    return $out;
  }

  //Make sure that there is a file
  if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {
         
    // Get filename
    $file_info = pathinfo($_FILES[$file_field]['name']);
    $name = $file_info['filename'];
    $ext = $file_info['extension'];
               
    //Check file has the right extension           
    if (!in_array($ext, $whitelist_ext)) {
      $out['error'][] = "Invalid file Extension";
    }
               
    //Check that the file is of the right type
    if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) {
      $out['error'][] = "Invalid file Type";
    }
               
    //Check that the file is not too big
    if ($_FILES[$file_field]["size"] > $max_size) {
      $out['error'][] = "File is too big";
    }
               
    //If $check image is set as true
    if ($check_image) {
      if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
        $out['error'][] = "Uploaded file is not a valid image";
      }
    }

    //Create full filename including path
    if ($random_name) {
      // Generate random filename
      $tmp = str_replace(array('.',' '), array('',''), microtime());
                       
      if (!$tmp || $tmp == '') {
        $out['error'][] = "File must have a name";
      }     
      $newname = $tmp.'.'.$ext;                                
    } else {
        $newname = $name.'.'.$ext;
    }
               
    //Check if file already exists on server
    if (file_exists($path.$newname)) {
      $out['error'][] = "A file with this name already exists";
    }

    if (count($out['error'])>0) {
      //The file has not correctly validated
      return $out;
    } 

    if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname)) {
        
        //mysql
        require_once("./assets/config/db.php");
		 	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$license = ($_POST["license"]);
		 	$track = ($_POST["track"]);
			$artist = ($_SESSION['user_name']);
			$description = ($_POST["description"]);
			
			$genre = ($_POST["genre"]);

			$tags = ($_POST["album"]);
			
		    $sql = "INSERT INTO Music (License, Track, Artist, filepath, Description,  Genre)
		            VALUES('$license', '$track', '$artist', '$path$newname', '$description',  '$genre')";	
			
			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}	
        
      //Success
      $out['filepath'] = $path;
      $out['filename'] = $newname;
      return $out;
    } else {
      $out['error'][] = "Server Error!";
    }
         
  } else {
    $out['error'][] = "No file uploaded";
    return $out;
  }      
}
?>


