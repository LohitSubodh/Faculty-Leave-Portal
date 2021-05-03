<?php
require 'vendor/autoload.php'; // include Composer's autoloader

//echo "ello";
   // connect to mongodb
   $m = new MongoDB\Client("mongodb://localhost:27017");
   //echo "ello";
   // select a database
   $db = $m->FacultyPortal;
   
   $collection = $db->faculty;
 
?>
