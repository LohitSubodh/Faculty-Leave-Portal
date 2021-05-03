<?php    
session_start();  
require_once('./connection_mongo.php');
    $con = pg_connect("host=localhost port=5432 dbname=postgres user=lohit password=postgres");
    if (!$con) {

        echo 'Connection attempt failed.';
        
        }
    $username = $_POST['user'];  
    $password = $_POST['pass'];
   // echo $username;
    //echo $password;  
      
        //to prevent from mysqli injection  
        if(isset($_POST['submit'])&&!empty($_POST['submit']))
        {
    
            $hashpassword = md5($_POST['pass']);
            $sql ="select * from login_info where username = '".pg_escape_string($_POST['user'])."' and password ='".$password."'";
            $data = pg_query($con,$sql); 

            if(!$data) {
                echo pg_last_error($con);
                exit;
          }
            $login_check = pg_num_rows($data);
            if($login_check > 0){ 
                
                echo "Login Successfully"; 
                
                
                $_SESSION["user_id"] = $username;
                $_SESSION["psw"] = $password;
                 $_SESSION["bool_logged_in"] = 5;
                 

            }
            else 
            {
                
                echo "Invalid Details\n";
                echo "hi \n";
            }
        }
        else
        {
            echo "Error\n";
        }

        $cursor = $collection->find();

    foreach($cursor as $document)
    {
    	if(strcmp($document["user_id"], $username)==0 && strcmp($document["password"], $password)==0)
      	{

           

        	$webadd = $document["web_add"];
            $_SESSION["webadd"] = "faculty/".$webadd;
           // header("Location: home.php");
        	//echo "same username $webadd";
        	
        }


    }

        header("Location: home.php");

        
?>  
