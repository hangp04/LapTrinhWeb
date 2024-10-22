<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="submit" name="cr_db" value="create_db">
</form>
<?php
	require_once '../employee_db/libs/database.php';
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		try {
			global $dbconn;
		// set the PDO error mode to exception
		connect_db();
		$sql = "CREATE DATABASE IF NOT EXISTS employee_db";
		// use exec() because no results are returned
		$dbconn->exec($sql);
		echo "Database created successfully<br>";
		} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
		}finally {
			disconnect_db(); // Ngắt kết nối
		}
	}
?>

</body>
</html>