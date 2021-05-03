<?php 
 require_once('../connection_mongo.php');
 $document = $collection->findOne(['user_id'=>'ramjee_repaka']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Edit Profile · Ramjee Repaka</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/blog/">

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
      <div class="col-4 d-flex justify-content-end align-items-center">
        
        
      </div>
    </div>
  </header>
    <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="ramjee.php">Visit Profile</a>
      <a class="p-2 text-muted" href="../start.php">LOGOUT</a>
    </nav>
  </div>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <?php
   echo '<h1 class="display-4 font-italic">'.$document['name'].'</h1>'; 
    echo '<p class ="small">'.$document['designation'].'<br>'.$document['department'].'<br>'.$document['institute'].'<br>'.'Email: '.$document['email_add'].'<br>';?>
    </div>
  </div>

<div>
  <div>
    <div>
          <hr>
          <div>
              <h3>EDIT/UPDATE OPTIONS</h3><br><hr>
              <h4>Edit existing content</h4><br>
              <form action="" method="POST">Enter title to change its content:
              <input type="text" name="title" id="title">
              <input type="submit" value="submit" name="submit_btn">
              </form>

              <?php
                  if(isset($_REQUEST['submit_btn']))
                  {
                      echo "<div>";
                          $title = $_POST["title"];
                     // echo $title;
                      $collectionedit = $db->ramjee;
                      $cursoredit = $collectionedit->find(['title' => $title]);

                      foreach($cursoredit as $documentedit)
                      {
                        echo '<h3>'.$documentedit['title'].'</h3><br>';
                        echo '<p>'.$documentedit['content'].'</p>'; 
                        echo '<form action="" method="POST"><label for="content">Change content</label><br><textarea id="content" name="content" style="height:200px" rows = "50" cols = "100">'.$documentedit['content'].'</textarea><br>
                          <textarea id="title" name="title" style="height:200px" rows = "10" cols = "50">'.$title.'</textarea><input type="submit" value="submitcontent" name = "submitcontent"></form>';   
                      }

                      echo "</div>";


                  }


              ?>

              <?php
                 if(isset($_REQUEST['submitcontent']))
                  {
                    $editcontent = $_POST["content"];
                    $title = $_POST["title"];
                    echo $editcontent;
                    $collectioneditcontent = $db->ramjee;
                  $collectioneditcontent->updateOne(
                    [ 'title' => $title ],
                    [
                      '$set' => [ "content" => $editcontent ],
                      
                    ]);
                    
                  //("title"=>$title), 
                  //array('$set'=>array("content"=>$editcontent)));
                    header("Location: edit_ramjee.php");

                  }
                  

              ?>
          </div>
          <hr>
          <div>
                <h4>Add new title</h4>
                <form action="" method="POST">
                <label for="newtitle">Title Name</label>
                <input type="text" id="newtitle" name="newtitle" placeholder="Enter title.."><br>

                <label for="contentnewtitle">Content</label><br>
                <input type =text id="contentnewtitle" name="contentnewtitle" style="height:200px"></textarea><br>
                <input type="submit" value="submit" name = "submitnewtitle">
                </form>
              

              <?php
                 if(isset($_REQUEST['submitnewtitle']))
                  {
                    $n_title = $_POST["newtitle"];
                    $n_content = $_POST["contentnewtitle"];
                    
                    $n_collection = $db->ramjee;
                    $n_document = [
                                    "title" => $n_title, 
                                    "content" => $n_content,
                    ];
  
                      $n_collection->insertOne($n_document);
                       header("Location: edit_ramjee.php");

                  }
                  

              ?>
          </div>
          <hr>
              <div>
                <h4>Delete title</h4>
                <form action="" method="POST">
                <label for="delete">Title Name to delete</label>
                <input type="text" id="delete" name="delete" placeholder="Enter title to delete.."><br>
                <input type="submit" value="submit" name = "submitdelete">
                </form>
              

              <?php
                 if(isset($_REQUEST['submitdelete']))
                  {
                    $d_title = $_POST["delete"];
                    
                    $d_collection = $db->ramjee;
                    $d_collection->deleteOne(["title"=>$d_title]);
                    header("Location: edit_ramjee.php");
                  }
              ?>
              </div>
              <hr>
               <h3 class="pb-4 mb-4 font-italic border-bottom">
        Current Academic Profile
      </h3>

      <div>
        <?php
          $collection2 = $db->ramjee;
          $cursor = $collection2->find();

          foreach($cursor as $document2)
          {
              echo '<h3>'.$document2['title'].'</h3><br>';
              echo '<p>'.$document2['content'].'</p>';    
          }


    
        ?>
        <hr>
        </div>

    </div><!-- /.blog-main -->


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
