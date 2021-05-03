<?php 
session_start();
echo $_SESSION["user_id"];
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");

$time = date('Y-m-d H:i:s');
$query = "INSERT into action values('$_SESSION[application_id]' , '$_SESSION[user_id]', 'comment', '$time')";

$res= pg_query($query);
if(!$res) {
      echo pg_last_error($db);
      exit;
}

$query = "SELECT redirect_id from application where application_id ='$_SESSION[application_id]'";
$res= pg_query($query);
if(!$res) {
      echo pg_last_error($db);
      exit;
}
$row = pg_fetch_row($res);
$redirect_id= $row[0];


$query = "INSERT into comments values ('$_SESSION[application_id]','$_POST[add_comment]', '$time','$_SESSION[user_id]','$redirect_id')";
$res= pg_query($query);
if(!$res) {
      echo pg_last_error($db);
      exit;
}

$query ="UPDATE application set curr_state_id = '$redirect_id' , redirect_id= '$_SESSION[user_id]' where application_id= '$_SESSION[application_id]'";

$res= pg_query($query);
if(!$res) 
{
    echo pg_last_error($db);
    exit;
}

header('Location:leave_status_user.php');

?>