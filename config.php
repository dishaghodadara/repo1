<?php

ob_start();

if(session_status()==PHP_SESSION_NONE){

    session_start();

}

// Database Connection with MySQL

// define constants for Database , Only for Localhost

define("DB_SERVER","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_NAME","loandb");

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if(!$link){

    die("Error: in Database Connection : ".mysqli_connect_error());
}
?>