<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "mrpc";


// Create connection
$con = new mysqli($servername, $username, $password);
// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Check database is exists
if (mysqli_select_db($con, $dbName)) {
	echo "Database exists";
	header("location: index.php");
} else {
	echo "Database does not exist";

	$sql = "CREATE DATABASE $dbName";
	if ($con->query($sql) === TRUE) {
		echo "Database created successfully";
		$conn = new mysqli($servername, $username, $password, $dbName);

		$query = '';
		$sqlScript = file('sanakin_db_sql.sql');
		foreach ($sqlScript as $line) {

			$startWith = substr(trim($line), 0, 2);
			$endWith = substr(trim($line), -1, 1);

			if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
				continue;
			}

			$query = $query . $line;
			if ($endWith == ';') {
				mysqli_query($conn, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
				$query = '';
			}
		}
		echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
		header("location: index.php");
	} else {
		echo "Error creating database: " . $con->error;
	}
}
?>