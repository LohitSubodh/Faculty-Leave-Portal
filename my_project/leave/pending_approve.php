<?php 
session_start();
//echo $_SESSION["user_id"];
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");


$query = "SELECT * from application where curr_state_id= '$id' and curr_status='pending'";
$ret = pg_query($query);
if(!$ret) 
{
    echo pg_last_error($db);
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Pending approval</title>
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


<h1> Pending Applications</h1>


<?php 


while($row = pg_fetch_row($ret))
{

	echo '
	<table style="width:100%" class="table">
<tr>
	<th>Application ID</th>
    <th>Name</th>
    
    <th>Reason</th>
    <th>Comments</th>
    <th>Days</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Time</th>
    <th>Status</th>
  </tr>
  <tr>
	<td>'.$row[0].'</td>
    <td>'. $row[1].'</td>
    
    <td>'. $row[2].'</td>
    <td>'.$row[3].'</td>
    <td>'. $row[4].'</td>
    <td>'.$row[5].'</td>
    <td>'.$row[6].'</td>
    <td>'.$row[7].'</td>
    <td>'.$row[8].'</td>
   </tr>
</table>';
	echo '<h2>Comment Section</h2>';

	$q = "SELECT user_id_by , user_id_to , comment_txt, time_stamp from comments where (user_id_by='$id' or user_id_to='$id') and application_id = '$row[0]'";
	$r= pg_query($q);
	 while($rw= pg_fetch_row($r))
	 {
	 	echo "From: ".$rw[0]."<br>
	 	To: ".$rw[1]."<br>
	 	comment: ".$rw[2]."<br>
	 	time: ".$rw[3]."<br><br>";
	 }
}
?>


<h2>Respond:</h2>

<form action="respond_comment.php" method="POST">
<div class="form-group">
	Application ID:<br>
  <input type="Number" name="application_id" placeholder="e.g.,5" class="form-control" >
  <br>
	<label for="content">Add comment</label><br>
	<textarea id ="content" name ="add_comment" style ="height:150px" rows="40" cols="80" class="form-control"></textarea>
</div>
  <input type="submit" name="approve" value="Approve" class="btn btn-default">
  <input type="submit" name="reject" value="Reject" class="btn btn-default">
  <input type="submit" name="redirect" value ="Redirect" class="btn btn-default">
</form> 

</body>
</html>



