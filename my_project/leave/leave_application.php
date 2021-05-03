<?php 
session_start();
//echo $_SESSION["user_id"];
$id=$_SESSION["user_id"];
$db = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");

$q ="select curr_leaves from faculty where user_id='$id'";
$r=pg_query($q);
$ros=pg_fetch_row($r);
if(!$ros) {
  echo pg_last_error($db);
  exit;
}
if($ros[0] == 0)
{
  $message = "You have 0 leaves remaining. You cannot apply";
            echo "<script type='text/javascript'>alert('$message');
            window.location.href='../faculty_portal.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 50px;
}
</style>
</head>
<body>

<h2 class = "display-1">Leave Application Form</h2>

<div class="form-group">
  <form action="leave.php" method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your name..">


    <label for="start_date">Start Date</label>
    <input type="text" id="start_date" name="start_date" placeholder="DD/MM/YYYY">


    <label for="end_date">End Date</label>
    <input type="text" id="end_date" name="end_date" placeholder="DD/MM/YYYY">
    
    <label for="num_leaves">Number of Days Required</label>
    <input type="Number"  class="form-control form-control-lg" id="num_leaves" name="num_leaves" placeholder="number of leaves needed..."><br><br>

    <label for="title">Title</label>
    <select id="title" name="title">
      <option value="sick">Sick</option>
      <option value="vacation">Vacation</option>
      <option value="retrospective">Retrospective Leave</option>
      <option value="Other">Other</option>
    </select>


    <label for="other_title">If other, specify</label>
    <input type="text" id="other_title" name="other_title" placeholder="other title...">

    <label for="comment">Comment</label>
    <textarea id="comment" name="comment" placeholder="add some comments.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
