<?php 

session_start();
 require_once('../connection_mongo.php');
 $db2 = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");
 $document = $collection->findOne(['user_id'=>'sk_das']);

  $username =$_SESSION["user_id"];
  
 //echo $username;



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Sk Das Profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/blog/">

    <!-- Bootstrap core CSS -->
<!-- <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      p.big{
        line-height: 1.5;
      }
      p.small{
        line-height: 1.5;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="blog.css" rel="stylesheet">
  </head>
  <body>
 
     
    <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="#"></a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#"></a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
       <!-- <a class="text-muted" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>-->
        <a class="btn btn-m btn-outline-secondary" href="../destroy.php"><?php if(isset($_SESSION["user_id"])){if(strcmp($_SESSION["user_id"],"sk_das")==0){echo "LogOut";}}?></a>
      </div>
    </div>
  </header>

  
      <!-- <a class="p-2 text-muted" href="#">Technology</a>
      <a class="p-2 text-muted" href="#">Design</a> -->


      <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="edit_sk.php"><?php if(isset($_SESSION["user_id"])){if(strcmp($_SESSION["user_id"],"sk_das")==0){echo "Edit Profile";}}?></a>
      <!-- <a class="p-2 text-muted" href="#">U.S.</a> -->
      <?php if(isset($_SESSION["user_id"])){if(strcmp($_SESSION["user_id"],"sk_das")==0){echo' <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Leave Application
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="../leave/leave_application.php">Apply Leave</a></li>
    <li><a href="../leave/leave_status_user.php">Leave Status</a></li>
    <li><a href="../leave/approve_leave.php">Approve Leave</a></li>
  </ul>
</div>';

}}?>
    </nav>
  </div>


  <?php
     $sql="select user_id from faculty where designation = 'director'";
     $ret = pg_query($db2, $sql);
     $dir=pg_fetch_row($ret);
     if(strcmp($_SESSION["user_id"],$dir[0])==0)
     {
       echo'<div class="nav-scroller py-1 mb-2">
       <nav class="nav d-flex justify-content-between">';

       if(isset($_SESSION["user_id"])){if(strcmp($_SESSION["user_id"],$username)==0){echo' <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Appoint HOD/DFA
        <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a  class="dropdown-item" href="../leave/appoint_hod.php">Change HOD </a></li>
          <li><a class="dropdown-item" href="../leave/appoint_dfa.php">Change DFA</a></li>
          
        </ul>
      </div>
      </nav>
      </div>'
    ;}}
     }

   ?>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <?php
   echo '<h1 class="display-4 font-italic">'.$document['name'].'</h1>'; 
    echo '<p class ="small">'.$document['designation'].'<br>'.$document['department'].'<br>'.$document['institute'].'<br>'.'Email: '.$document['email_add'].'<br>';?>
    </div>
  </div>

  <!-- <div class="row mb-2">
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div>
  <div>
    <div>
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        Academic Profile
      </h3>

      
      <div>
        <?php
          $collection2 = $db->sk;
          $cursor = $collection2->find();

          foreach($cursor as $document2)
          {
              echo '<h3>'.$document2['title'].'</h3><br>';
              echo '<p>'.$document2['content'].'</p>';    
          }
          /*echo '<h3>Research interests</h3><br>';
              echo '<p>'.$document['research_interests'].'</p>';  

              echo '<h3>Courses Taught </h3><br>';
              echo '<p>'.$document['teaching'].'</p>';  
          
              echo '<h3>Education </h3><br>';
              echo '<p>'.$document['education'].'</p>';  

              echo '<h3>Work Experience </h3><br>';
              echo '<p>'.$document['work_experience'].'</p>';
              
              echo '<h3>Academic visits </h3><br>';
              echo '<p>'.$document['academic_visits'].'</p>';  

              echo '<h3>Publications </h3><br>';
              echo '<p>'.$document['publications'].'</p>';

              echo '<h3>Program Committe Work </h3><br>';
              echo '<p>'.$document['program_committe_work'].'</p>';*/


    
    
        ?>
</div>
  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
  <!-- <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p> -->
    <a href="#">Back to top</a>
  </p>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
