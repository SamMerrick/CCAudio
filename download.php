<?php 
	include("views/header.php"); 
	require_once("assets/config/db.php");

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ($conn->connect_error) { die("Connection failed:".$conn->connect_error); }
	
	$q = $_GET['q'];
	$sql = "SELECT * FROM Music WHERE ID='$q'";				
	$result = $conn->query($sql);     
?>

<div id="submissions">	
    <h3>Download..</h3>	
<?php

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) { 
	
		$track = $row["Track"];
		$artist = $row["Artist"];
		$file = $row["filepath"]
	
	
	?>  

	<div class="submission">
		<div class="img"> <img src="<?php echo $row["albumpath"];?> "> </div>

		<div class="header"> 
			<a class="play" href="#" onclick="wavesurfer<?php echo $count;?>.playPause()">		
				<img id='playpause' src="assets/images/play.png" data-swap="assets/images/pause.png">
			</a> 

			<p class="artist"><?php echo $row["Artist"]?></p>
			<p class="track"><?php echo $row["Track"]?></p>	
		</div>

		<div class="container">		   
			<div id ="container<?php echo $count;?>">                                                            
				<div id="waveform">
					<script>
						var count = "<?php echo $count;?>";
						var wavesurfer<?php echo $count; ?> = Object.create(WaveSurfer);
						wavesurfer<?php echo $count; ?>.init({
						container: '#container<?php echo $count; ?>',
						waveColor: '#bfbfbf',
						progressColor: 'black',
						cursorColor: 'rgba(0,0,0,0)',
						normalize: true,
						barWidth:2.5,
						height:50,
						fillParent:true
						});									
						wavesurfer<?php echo $count; ?>.load("<?php echo $row["filepath"]?>"); 
					</script>
				</div>                 
			</div>
		</div>
	</div>     
	
	<div class="downloadconditions">	
		<form class="downloadform" method="post" action="">
			
			<?php	
				$Public	       ='<div class="condition"> <img src="assets/images/cc/zero.png">			<p>Free to use without restriction</p></div>';
				$Attribution   ='<div class="condition"> <img src="assets/images/cc/attribution.png">	<p>Must give credit to the original artist</p></div>';								  
				$Sharealike    ='<div class="condition"> <img src="assets/images/cc/sharealike.png">	<p>Must distribute derivatives under an identical license</p></div>';								  
				$Noderivative  ='<div class="condition"> <img src="assets/images/cc/noderivative.png">	<p>Must not be altered in any way</p></div>';
				$Noncommercial ='<div class="condition"> <img src="assets/images/cc/noncommercial.png">	<p>Must not be used commercially</p></div>';								  
				
				$Check = '<input type="checkbox" required></input>';
					
										  
				$by 		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by/4.0/">		<img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" />		</a><br /><a rel="license" href="http://creativecommons.org/licenses/by/4.0/"></a></div>';
				$bysa 		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">	<img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" />		</a><br /><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"></a></div>';
				$bynd		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by-nd/4.0/">	<img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nd/4.0/88x31.png" />		</a><br /><a rel="license" href="http://creativecommons.org/licenses/by-nd/4.0/"></a></div>';
				$bync		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" />		</a><br /><a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"></a></div>';
				$byncsa		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" />	</a><br /><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"></a></div>';
				$byncnd		='<div id="ccorg"><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" />	</a><br /><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"></a></div>';					  
										  
						  
										  
				echo '<br><br>', 'By downloading you agree to the following conditions;';								  
				if ($row["License"] == 0) { echo $Public; }
				if ($row["License"] == 1) { echo $by, $Attribution; }
				if ($row["License"] == 2) { echo $bysa, $Attribution, $Sharealike; }
				if ($row["License"] == 3) { echo $bynd, $Attribution, $Noderivative; }
				if ($row["License"] == 4) { echo $bync, $Attribution, $Noncommercial; }
				if ($row["License"] == 5) { echo $byncsa, $Attribution, $Noncommercial, $Sharealike; }
				if ($row["License"] == 6) { echo $byncnd, $Attribution, $Noncommercial, $Noderivative; }  
			?>
			<a href="<?php echo $row["filepath"]?>" download><input type="submit" value="Download"></input></a>
			<br>(right click Save Link As)

	
		</form>
	</div> 
</div>

<?php

?>



<?php } } $conn->close(); ?>	


