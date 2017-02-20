<?php
session_start();
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
      header("location: ../index.php");
  }else{
  	header("location: ../../index.php");
  }
?>