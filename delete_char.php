<?php
/////////////////////////////////////////////////////////////////////////////////////////
// Defective Minds RPG (c) 2009 Seth Parson and Will Delahoussaye
// http://www.defectiveminds.com/
/////////////////////////////////////////////////////////////////////////////////////////

include("rpg_header.php");
$data=getuserdata($_SESSION['valid_user']);

if($_SESSION["logged_in"]!="true")
{
  	rpg_refresh("top","index.php");
    include("rpg_footer.php"); exit();
}

if($action=="delete_go")
{
	echo "<p><center>\n";
	rpg_deletechar();
	rpg_reload();
	echo "</center></p>\n";
}

if($data->rpg=="yes")
{
	echo "<p><center>Are you sure you want to delete your character?";
	echo " [<a href=delete_char.php?action=delete_go>yes</a>]";
	echo " [<a href=rpg_main.php>no</a>]";
	echo "</center></p>";

}
else
{
	echo "<p><center>You must create a character!</center></p>\n";

}

include("rpg_footer.php");


?>

