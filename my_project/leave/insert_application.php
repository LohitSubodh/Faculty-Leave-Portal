<?php
session_start();
$id =$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");


$query = "SELECT  user_id , curr_status from application ";

$ret = pg_query($db ,$query);
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

$query = "SELECT  designation ,curr_leaves from faculty where user_id= '$id' ";
$result = pg_query($db , $query);
 if(!$result) {
      echo pg_last_error($db);
      exit;
}

$row = pg_fetch_row($result);

$curr_state = $row[0];
$curr_state =strtolower($curr_state);

$query = "SELECT  process_id from process where process_typ= '$curr_state' ";
$result = pg_query($db , $query);
 if(!$result) {
      echo pg_last_error($db);
      exit;
}

$row_1 = pg_fetch_row($result);

$process_typ = $row_1[0];
$leaves_remaining= $row[1];

echo "process_id: ".$process_typ."curr_state: ".$curr_state.'<br>';

$query = "SELECT  next_state from transition where process_id ='$process_typ' and curr_state = '$curr_state' ";
$result = pg_query($query);
 if(!$result) {
      echo pg_last_error($db);
      exit;
}    

$row = pg_fetch_row($result);
$next_state = $row[0];
$next_state = strtolower($next_state);
echo "next state : ".$next_state.'<br>';

$query_dep = "SELECT  department from faculty where user_id='$id' ";
$result = pg_query($query_dep);
 if(!$result) {
      echo pg_last_error($db);
      exit;
}
$row = pg_fetch_row($result);
$department = $row[0];
if($next_state == 'director')
{
      $query = "SELECT  user_id from faculty where designation= '$next_state' ";
$result = pg_query($query);
 if(!$result) {
      echo pg_last_error($db);
      exit;

}
}
else
{
$query = "SELECT  user_id from faculty where designation= '$next_state' and department= '$department'";
$result = pg_query($query);
 if(!$result) {
      echo pg_last_error($db);
      exit;
}
}

$row = pg_fetch_row($result);
$curr_state_id = $row[0];
$process_id= $process_typ;

//echo "leaves: ".$_SESSION["num_leaves"];

echo "curr state id: ".$curr_state_id.'<br>'; 

$query = "INSERT INTO application VALUES (default,'$id','$_SESSION[title]','$_SESSION[comment]','$_SESSION[num_leaves]',to_date('$_SESSION[start_date]','DD/MM/YYYY'),to_date('$_SESSION[end_date]','DD/MM/YYYY'),current_timestamp,'pending','$curr_state_id','$process_id','$leaves_remaining','$id')";
 $result = pg_query($query); 
 if(!$result) {
   echo pg_last_error($db);
   exit;
}   
 echo "Successfully posted the application!!";
 pg_close($db);
 echo '<a href="../faculty_portal.php" >Back to home page</a>';
?>

