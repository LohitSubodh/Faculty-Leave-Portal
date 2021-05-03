<?php
  session_start();
  require_once('./connection_mongo.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">

    <title>Faculty Portal Home</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


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
    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">This faculty portal is made as part of database management system project work . The data of faculty used in the webpages of this portal is solely for only representation and not for any use, the data is randomly taken from different sources and none of the information is completly true.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">DEPARTMENTAL FACULTY LIST-</h4>
          <ul class="list-unstyled">
            <li><a href="faculty/facultylistCSE.php" class="text-white">Computer Science & Engg.</a></li>
            <li><a href="faculty/facultylistME.php" class="text-white">Mechanical Engg.</a></li>
            <li><a href="faculty/facultylistEE.php" class="text-white">Electrical Engg.</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="home.php" class="navbar-brand d-flex align-items-center">
        
        <strong>FACULTY PORTAL</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Welcome!</h1>
      
      <?php
        
        if(isset($_SESSION["bool_logged_in"]))
        {
          echo '<p class="lead text-muted">You have successfully logged in!.</p>
                <p><button type="button" style="width:auto;" ><a href='.$_SESSION["webadd"].' class="btn btn-primary" >VISIT YOUR PROFILE</a></button><button  style="width:auto;"><a href="destroy.php" class="btn btn-danger" >LOGOUT</a></button>
                </p>';
        }
        else
        {
          echo '<p class="lead text-muted">Faculty? Login here to see and manage your profile.</p>
                <p><button  style="width:auto;"><a href="login.html" >LOGIN AS FACULTY</a></button>
                </p>'
                ;
        }
      ?>
      
    </div>
  </section>

  <div class="album py-6 bg-light">
    <div class="container">

      <div class="row row-centered">
        <div class="col-md-4">
        <div class="text-center card-box">
          <div class="card mb-4 shadow-sm">

          <div class="thumb-xl member-thumb m-b-10 center-block">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle img-thumbnail" alt="profile-image">
                    </div>
          <!--  <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><image href="https://bootdey.com/img/Content/avatar/avatar6.png" x="0" y="0" height="250px" width="310px"/></svg>
          -->
            
              <p class="card-text">
              <?php
                    $document = $collection->findOne(['user_id'=>$_SESSION["user_id"]]);
                    echo '<h3>'.$document['name'].'</h3>'; 
                    echo '<p class ="small">'.$document['designation'].'<br>'.$document['institute'].'<br>'.'Email: '.$document['email_add'].'<br>';
              ?></p>
              
            </div>
          </div>
        </div>
        
        

  </div>

</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="home.php">Back to top</a>
    </p>
    
  </div>
</footer>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>
</html>
