<?php
include("dm_config.php");
//if($_SESSION["logged_in"]!="true") {  exit(); }
$data=getuserdata($_SESSION['valid_user']);

if(empty($data->rpg_name)) $data->rpg_name="WTF?";

$returnVars = array();
$returnVars['userz'] = $data->rpg_name;
$returnVars['email'] = $data->email;
$returnString = http_build_query($returnVars);

//send variables back to Flash
echo $returnString;

?>