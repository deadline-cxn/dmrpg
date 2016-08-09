<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");

if($_SESSION["logged_in"]!="true") {
    rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}

$data=getuserdata($_SESSION['valid_user']);

if($data->rpg=="yes") {
    echo "<h1>Help</h1>";
}
else
{
    echo "<p>Create a character first!</p>\n";
}

include("rpg_footer.php");

