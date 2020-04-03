<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location:http://localhost/final/login/web.html"); // Redirecting To Home Page
}
?>