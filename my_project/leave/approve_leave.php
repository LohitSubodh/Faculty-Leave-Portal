<?php
session_start();
$id = $_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");

$query = "SELECT  designation from faculty where user_id='$id'";
$ret = pg_query($db, $query);
if(!$ret) {
    echo pg_last_error($db);
    exit;
}

while ($row = pg_fetch_row($ret))
{
	if(strcmp($row[0] , "Faculty_CSE" )!=0 && strcmp($row[0], "Faculty_EE")!=0 && strcmp($row[0], "Faculty_ME")!=0  )
	{
		header('Location:show_approve_page.php',false);
		exit;
	}
	# code...
}

echo "Not a desired designation for approving the requests!!! ";

?>




