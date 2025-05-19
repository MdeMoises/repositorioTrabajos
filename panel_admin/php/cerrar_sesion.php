<?php
    //session_start();
	session_destroy();
    setcookie(session_name(), '',-3600, '/');
	if(headers_sent()){
		echo "<script> window.location.href='../index.php'; </script>";
	}else{
		header("Location: ../index.php");
	}