<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("dm_config.php");
$data=getuserdata($_SESSION['valid_user']);
echo "<html><head><title>Log out</title></head><body bgcolor=ff9900 text=000000><font face=verdana size=1><b><p>$data->name... you are now logged out!</p>\n";
session_destroy();
echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=$locate/\">";
echo "</body></html>\n";
