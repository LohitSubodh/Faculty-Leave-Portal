<?php
session_start();
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");

if(!$db) {
      echo "Error : Unable to open database\n";
   }

//echo $id;

$query ="SELECT curr_leaves , next_leaves,designation from faculty where user_id = '$_SESSION[user_id]'";
$res = pg_query($query);
if(!$res) {
      echo pg_last_error($db);
      exit;
}
$row_1 = pg_fetch_row($res);
echo "<h2 class = 'display-2'>Remaining Leaves Of This Year</h2>"."<h3>".$row_1[0]."</h3>";
//echo "<h2 class = 'display-2'>Remaining Leaves Of Upcoming Year</h2>"."<h3>".$row_1[1]."</h3>";




$query = "SELECT * from application where user_id = '$id' and curr_status='pending'";
$ret = pg_query($db, $query);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

$row = pg_fetch_row($ret);
$bool = $row;
$application_id = $row[0];
$title=$row[2];
$redirect_id = $row[12];
$_SESSION["application_id"]=$application_id;
//echo $application_id;
//echo $bool;
//echo $row[2];

// leave is not approved or rejected before start date

$time = (date('Y-m-d '));
//echo $row[5];
//echo $time;
$start_time= $row[5];
//echo $start_time;

if($time >= $start_time && is_numeric($application_id) && strcmp($title,'retrospective')!=0 && $bool !=0)
{
   echo '<script type="text/javascript">'; 
   echo 'alert("Time limit exceeded");'; 
   echo '</script>';
   $q1 = "UPDATE application  set curr_status='Rejected' , curr_state_id= '$id' where application_id= '$application_id ' ";
		$r1 = pg_query($q1);
 		if(!$r1) {
      	echo pg_last_error($db);
      	exit;
		}
       
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<h1>Pending Leave Application</h1>
<table  class="table table-striped">
<tr>
    <th>Apllication_id</th>
    
    <th>Reason</th>
    <th>Comments</th>
    <th>Days</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Time</th>
    <th> Current state id</th>
    <th>Status</th>
  </tr>
  <tr>
    <td><?php echo $row[0]?></td>
    
    <td><?php echo $row[2]?></td>
    <td><?php echo $row[3]?></td>
    <td><?php echo $row[4]?></td>
    <td><?php echo $row[5]?></td>
    <td><?php echo $row[6]?></td>
    <td><?php echo $row[7]?></td>
    <td><?php echo $row[9]?></td>
    <td><?php echo $row[8]?></td>
</table>


<?php 
if($bool!=0)
{

echo "<h2>Comments on pending request</h2>";

$query = "SELECT user_id , time_stamp ,action_typ from action where application_id='$application_id'";
$ret = pg_query($db, $query);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }



while($row = pg_fetch_row($ret))
{
	//echo "row: ".$row[1];
	$q= "SELECT name , designation from faculty where user_id ='".$row[0]."'";
	$res= pg_query($q);
	$r = pg_fetch_row($res);
	echo "Faculty: ".$r[0]."<br>";
	echo "Designation: ".$r[1]."<br>";
	echo "Action: ".$row[2]."<br>";
	echo "Time: ".$row[1]."<br><br>";

	$q="SELECT comment_txt from comments , action where action.user_id= comments.user_id_by and comments.user_id_by= '$row[0]' and action.time_stamp = comments.time_stamp and action.time_stamp = '$row[1]' and action.application_id = comments.application_id and comments.application_id = '$application_id'";
	$r = pg_query($q);
	while($p = pg_fetch_row($r))
	{
		echo "Comment: ".$p[0]."<br><br>";
	}
}   


}


if(strcmp($redirect_id,$id)!=0 and $bool!=0)
{
	echo '<h2>Respond:</h2>

<form action="add_comment.php" method="POST">
	<label for="content">Add comment</label><br>
	<textarea id ="content" name ="add_comment" style ="height:150px" rows="40" cols="80"></textarea>
  <input type="submit" value="Submit">
</form> ';

}




?>

<h1> History Of Leave Applications</h1>
<table class="table table-striped">
<tr>
    <th>Application_id</th>
    <th>Designation</th> 
    <th>Reason</th>
    <th>Leaves Remaining</th>
    <th>Days</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Time</th>
    <th> Current state id</th>
    <th>Status</th>
  </tr>


<?php 

$query = "SELECT * from application where user_id ='$id' and curr_status<> 'pending'";
$ret = pg_query($db, $query);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }



while($row = pg_fetch_row($ret))
{

	echo '<tr>
    <td>'. $row[0].'</td>
    <td>'. $row_1[2].'</td>
    <td>'. $row[2].'</td>
    <td>'.$row[11].'</td>
    <td>'. $row[4].'</td>
    <td>'.$row[5].'</td>
    <td>'.$row[6].'</td>
    <td>'.$row[7].'</td>
    <td>'.$row[9].'</td>
    <td>'.$row[8].'</td>';

}

?>
</table>

<h1> Show comments of past Leave Applications</h1>
<?php

$query = "SELECT * from application where user_id ='$id' and curr_status<> 'pending'";
$ret = pg_query($db, $query);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }

   while($row = pg_fetch_row($ret))
   {
   
   $q = "SELECT user_id_by , user_id_to , comment_txt, time_stamp from comments where  application_id = '$row[0]'";
	$r= pg_query($q);
	 while($rw= pg_fetch_row($r))
	 {
	 	echo "application_id: ".$row[0]."<br>
       From: ".$rw[0]."<br>
	 	To: ".$rw[1]."<br>
	 	comment: ".$rw[2]."<br>
	 	time: ".$rw[3]."<br><br>";
	 }
   }

?>




</body>
</html>





