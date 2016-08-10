<?php
include("rpg_header.php");
if($_SESSION["logged_in"]!="true") {  exit(); }
$data=getuserdata($_SESSION['valid_user']);


flash("flash/wtf.swf",400,300);


?>