<html>

<head>

	<title>User List</title>
	
</head>

<body>

<h1>User List</h1>
<a href="user-addw.php"><button>Add User</button></a>

<?php

require_once  'loginw.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM Users";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++)
{
	$result->data_seek($j); 
	$row = $result->fetch_array(MYSQLI_ASSOC); 


echo <<<_END
	<pre>
	
	<h1><a href = 'user-detailsw.php'>$row[forename]
		$row[surname]</a></h1>

	username: $row[username]
	forename: $row[forename]
	surname: $row[surname]
	password: $row[password]	
	</pre>
	_END;
}

$conn->close();



?>