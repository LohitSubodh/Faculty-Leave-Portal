<?php 
session_start();
echo $_SESSION["user_id"];
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");

if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }


$query = "SELECT  user_id , curr_status from application ";

$ret = pg_query($db, $query);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
while ($row = pg_fetch_row($ret)) {
	if(strcmp($row[0] , $id )==0 && strcmp($row[1], "pending")==0 )
	{
		header('Location:error_leave.php',false);
		exit;
	}
	# code...
}
pg_close($db);


if(strcmp($_POST["title"],"Other")==0)
{
   $_SESSION["title"]=$_POST["other_title"];
}
else
{
   $_SESSION["title"] = $_POST["title"];
}

$_SESSION["comment"] = $_POST["comment"];
$_SESSION["start_date"]= $_POST["start_date"];
$_SESSION["end_date"] = $_POST["end_date"];
$_SESSION["num_leaves"] = $_POST["num_leaves"];
$_SESSION["name"] = $_POST["name"];
echo $_SESSION["num_leaves"];
header('Location:insert_application.php',false);

?>


