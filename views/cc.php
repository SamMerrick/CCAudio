 <div class="cc">
<?php
	$Public = 		'<img src="assets/images/cc/zero.png" 			class="masterTooltip" 	title="Free to use without restriction">';
	$Attribution = 	'<img src="assets/images/cc/attribution.png" 	class="masterTooltip" 	title="Must give credit to the original artist">';								  
	$Sharealike = 	'<img src="assets/images/cc/sharealike.png" 	class="masterTooltip" 	title="Must distribute derivatives under an identical license">';								  
	$Noderivative = '<img src="assets/images/cc/noderivative.png" 	class="masterTooltip" 	title="Must not be altered in any way">';
	$Noncommercial ='<img src="assets/images/cc/noncommercial.png" 	class="masterTooltip" 	title="Must not be used commercially">';								  


	 
	 
	 
	 
	 
	 
	if ($row["License"] == 0) { echo $Public 										; }
	if ($row["License"] == 1) { echo $Attribution 									; }
	if ($row["License"] == 2) { echo $Attribution, $Sharealike 						; }
	if ($row["License"] == 3) { echo $Attribution, $Noderivative 					; }
	if ($row["License"] == 4) { echo $Attribution, $Noncommercial 					; }
	if ($row["License"] == 5) { echo $Attribution, $Noncommercial, $Sharealike 		; }
	if ($row["License"] == 6) { echo $Attribution, $Noncommercial, $Noderivative 	; }  
	 

?>
</div>   