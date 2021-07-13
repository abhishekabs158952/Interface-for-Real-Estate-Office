<!DOCTYPE html> 
<html> 
<head>
	<title>JSON in PHP and JavaScript</title>
	
</head> 
<body> 
<center> 
	<h1>ICON in PHP and JavaScript</h1> 
	<H2> PART 2: JSON.parse</H2> 
	<?php
	$emp = ["id" => 1, "name" => "Vijay", "addr" => "pune"];
    $json = json_encode ($emp);
    
	?>
</center> 
</body> 
<script type="text/javascript"> 
	var emp = <?= $json?>; 
	console.log(emp.name); 
</script> 
</html>