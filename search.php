<?php include("views/header.php"); ?>

<div id="submissions">	
		<h3>Search Results for <?php echo $_GET['q'];?></h3>		
		
        <?php
			//Define Pagination Start and limit points
			$start=0;
			$limit=4;
		
			//If Pagination is set..
			if(isset($_GET['page']))
			{
				$id=$_GET['page'];
				$start=($id-1)*$limit;
			}
			else{
				$id=1;
			}
	
			$q = $_GET['q'];

			//connect to DB
			require_once("assets/config/db.php");
			$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			
			
			//Error checking
			if ($conn->connect_error) { die("Connection failed:".$conn->connect_error); }
		
			$count = "SELECT * FROM Music ORDER BY `id` DESC";		
			$countresult = $conn->query($count);  
	
			$sql = "SELECT *
					FROM Music 
					WHERE MATCH (Track,Artist,Genre,Description)
					AGAINST ('$q')
			
			ORDER BY `id` DESC LIMIT $start, $limit";		
			$result = $conn->query($sql);  
			$countresult = $conn->query($sql);  

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { ?>  
					<div class="submission">

						<div class="img"> 
							<img src="<?php echo $row["albumpath"];?>"> 	
						</div>

						<a class="genre" href="search.php?q=<?php echo $row["Genre"]?>">
							<?php echo $row["Genre"]?>
						</a>


						<div class="header"> 
							<a class="play" href="#" onclick="wavesurfer<?php echo $row["id"];?>.playPause()">		
								<img id='playpause' src="assets/images/play.png">
							</a> 

							<p class="artist">
								<a href="search.php?q=<?php echo $row["Artist"];?>">
									<?php echo $row["Artist"]?>
								</a>
							</p>

							<p class="track">
								<?php echo $row["Track"]?>
							</p>					
						</div>

						<div class="container">		   
							<div id ="container<?php echo $row["id"];?>">                                                            
								<div id="waveform">
									<script>
										var wavesurfer<?php echo $row["id"]; ?> = Object.create(WaveSurfer);
										wavesurfer<?php echo $row["id"]; ?>.init({
										container: '#container<?php echo $row["id"]; ?>',
										waveColor: '#bfbfbf',
										progressColor: 'black',
										cursorColor: 'rgba(0,0,0,0)',
										normalize: true,
										barWidth:2.5,
										height:50,
										fillParent:true
										});									
										wavesurfer<?php echo $row["id"]; ?>.load("<?php echo $row["filepath"]?>"); 		
									</script>	
								</div>                 
							</div>
						</div>

						<div class="playd">	
							<a href="download.php?q=<?php echo $row["id"];?>">
								<img src="assets/images/download.png" class="download">
							</a>
						</div>



						<?php include("views/cc.php");?>		

				   </div>     
			<?php } } 

			//fetch all the data from database.
			$rows=mysqli_num_rows($countresult);
			//calculate total page number for the given table in the database 
			$total=ceil($rows/$limit);
			
			?>
			<ul class='page'>
			<?php
			//show all the page link with page number. When click on these numbers go to particular page. 
					for($i=1;$i<=$total;$i++)
					{
						if($i==$id) { echo "<li class='current'>".$i."</li>"; }

						else { echo "<li><a href='?q=".($q)."&page=".$i."'>".$i."</a></li>"; }
					}
			?>
			</ul>



			<?php $conn->close(); ?>	

    
	</div>