<?php include '/includes/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>mail test</title>
</head>
<body>
<form action="mailer.php" method="post">
	 	
	<?php 
	$email = "vi.kartsivadze@gmail.com";
	$to = "test.kartsivadze@gmail.com".",".$email; 
	echo "$to";?>
</form>
</body>
</html>