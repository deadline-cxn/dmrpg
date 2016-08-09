<?php
include("dm_config.php");
//if($HTTP_SESSION_VARS["logged_in"]!="true") {  exit(); }
$data=getuserdata($HTTP_SESSION_VARS['valid_user']);

if(empty($data->rpg_name)) $data->rpg_name="WTF?";

$returnVars = array();
$returnVars['userz'] = $data->rpg_name;
$returnVars['email'] = $data->email;
$returnString = http_build_query($returnVars);

//send variables back to Flash
echo $returnString;

?>