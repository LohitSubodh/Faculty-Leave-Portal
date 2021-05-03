<?php 
session_start();
//echo $_SESSION["user_id"];
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");
?>

<?php
 if(isset($_POST['submit'])&&!empty($_POST['submit']))
 {
$username = $_POST['user_id'];  
$department = $_POST['department'];
echo 'Username: '.$username.'<br> 
Department :'. $department.'<br>';

$q="select user_id from faculty where designation='hod' and department='$department'";
$r=pg_query($q);
$ros=pg_fetch_row($r);
if(!$ros) {
  echo pg_last_error($db);
  exit;
}
echo 'prev: '.$ros[0].'<br>';


$q1 ="update faculty
set  designation='hod'
where user_id='$username' and department='$department'";
$r=pg_query($q1);
if(!$r) {
  echo pg_last_error($db);
  exit;
}


$q2="update faculty set designation='faculty' where user_id='$ros[0]'";
$r=pg_query($q2);
if(!$r) {
  echo pg_last_error($db);
  exit;
}

$q3="update application set curr_state_id='$username' where curr_state_id='$ros[0]' and curr_status='pending'";
$r3=pg_query($q3);

echo "Changed successfully!!"."<br>";
echo '<a href="../faculty_portal.php" >Back </a>';

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Appoint HOD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>  Appoint new HOD </h1>
<form action="#" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">User_id</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name ="user_id" aria-describedby="emailHelp" placeholder="Enter user_id">
   <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
  </div>
  <div class="form-group">
  <label for="title">Department</label>
    <select id="title" name="department">
      <option value="cse">CSE</option>
      <option value="ee">EE</option>
      <option value="me">ME</option>
      
    </select>

  </div>
  
  <input type="submit" name="submit" class="btn btn-primary" value="Submit">
</form>

</body>
</html>