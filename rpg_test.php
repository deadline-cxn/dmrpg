<?php
include("rpg_header.php");
if($HTTP_SESSION_VARS["logged_in"]!="true") {  exit(); }
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);


flash("flash/wtf.swf",400,300);


?>